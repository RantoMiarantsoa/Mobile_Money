<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table         = 'client';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['nom', 'telephone'];
    protected $returnType    = 'array';
    protected $useTimestamps = false;

    // Numéro malgache : 0 + préfixe (32,33,34,37,38) + 7 chiffres
    protected $validationRules = [
        'nom'       => 'required|min_length[2]|max_length[150]',
       'telephone' => 'required|regex_match[/^(034|038)[0-9]{7}$/]'
    ];

    protected $validationMessages = [
        'nom' => [
            'required'   => 'Le nom du client est obligatoire.',
            'min_length' => 'Le nom doit contenir au moins 2 caractères.',
        ],
        'telephone' => [
            'required'    => 'Le numéro de téléphone est obligatoire.',
            'regex_match' => 'Le numéro doit être un numéro malgache valide (ex: 0341234567).',
            'is_unique'   => 'Ce numéro de téléphone est déjà enregistré.',
        ],
    ];

    protected $skipValidation = false;

    /**
     * Récupère un client par son numéro de téléphone, ou le crée
     * automatiquement s'il n'existe pas encore (pas d'inscription préalable).
     */
    public function findOrCreateByTelephone(string $telephone, ?string $nom = null): array|false
    {
        $client = $this->where('telephone', $telephone)->first();

        if ($client) {
            return $client;
        }

        // On ne valide ici que le format du téléphone, le nom est optionnel à la création
        $id = $this->skipValidation(false)->insert([
            'nom'       => $nom ?: $telephone,
            'telephone' => $telephone,
        ], true);

        if (! $id) {
            return false;
        }

        return $this->find($id);
    }

    public function getIdByTelephone(string $telephone): ?int
{
    $client = $this->where('telephone', $telephone)->first();

    return $client ? (int) $client['id'] : null;
}

public function findByTelephone(string $telephone)
{
    return $this
        ->where('telephone', trim($telephone))
        ->first();
}
}
