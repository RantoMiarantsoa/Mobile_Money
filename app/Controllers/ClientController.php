<?php

namespace App\Controllers;

use App\Models\OperationModel;
use App\Models\SoldeModel;

class ClientController extends BaseController
{

    public function accueil()
    {
        if (!session()->get('connecte')) {
            return redirect()->to('/login');
        }

        $idClient = session()->get('id_client');

        $soldeModel = new SoldeModel();
        $solde = $soldeModel->calculerSolde($idClient);

        $operationModel  = new OperationModel();
        $historique       = $operationModel->getHistoriqueClient($idClient);
        $operationsRecentes = array_map(function ($op) use ($idClient) {
            $sens = ($op['type_operation'] === 'Depot' || (int) $op['client_destination'] === (int) $idClient)
                ? 'in'
                : 'out';

            return [
                'type_operation'  => $op['type_operation'],
                'date_operation'  => $op['date_operation'],
                'montant'         => $op['montant'],
                'sens'            => $sens,
                'destination'     => $op['telephone_client'] ?? '',
            ];
        }, array_slice($historique, 0, 5));

        return view('client/accueil', [
            'nom'                 => session()->get('nom'),
            'telephone'           => session()->get('telephone'),
            'solde'               => $solde,
            'operationsRecentes'  => $operationsRecentes,
        ]);
    }


    public function depot()
    {
        return view('client/depot');
    }


    public function retrait()
    {
        return view('client/retrait');
    }


    public function transfert()
    {
        $operateur = $this->request->getGet('operateur');

        if (empty($operateur)) {
            return view('client/transfert_choix');
        }

        return view('client/transfert', [
            'operateur' => $operateur
        ]);
    }


    public function historique()
    {
        $idClient = session()->get('id_client');

        if (!$idClient) {
            return redirect()->to('/login');
        }

        $operationModel = new OperationModel();
        $brut           = $operationModel->getHistoriqueClient($idClient);

        $historique = array_map(function ($op) use ($idClient) {
            $type = $op['type_operation'];
            $sens = ($type === 'Depot' || (int) $op['client_destination'] === (int) $idClient)
                ? 'in'
                : 'out';

            switch (true) {
                case $type === 'Depot':
                    $libelle = 'Via agence mobile';
                    break;

                case $type === 'Retrait':
                    $libelle = 'Retrait espèces';
                    break;

                case $sens === 'in':
                    $libelle = 'Transfert reçu';
                    break;

                default:
                    $libelle = 'Vers ' . ($op['telephone_destination'] ?? '-');
            }

            return [
                'type_operation' => $type,
                'date_operation' => $op['date_operation'],
                'libelle'        => $libelle,
                'montant'        => $op['montant'],
                'frais'          => $op['frais'],
                'sens'           => $sens,
            ];
        }, $brut);

        $totalEntrees = array_sum(array_column(array_filter($historique, fn ($o) => $o['sens'] === 'in'), 'montant'));
        $totalSorties = array_sum(array_column(array_filter($historique, fn ($o) => $o['sens'] === 'out'), 'montant'));

        return view('client/historique', [
            'historique'    => $historique,
            'nombreTotal'   => count($historique),
            'totalEntrees'  => $totalEntrees,
            'totalSorties'  => $totalSorties,
        ]);
    }

}