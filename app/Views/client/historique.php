<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Historique des opérations</title>


<link 
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet"
>


</head>


<body class="bg-light">


<div class="container mt-5">


    <div class="card shadow-lg border-0 rounded-4">


        <div class="card-body">


            <h2 class="text-center mb-4">
                📜 Historique de mes opérations
            </h2>



            <?php if(empty($historique)): ?>


                <div class="alert alert-info text-center">

                    Aucune opération effectuée.

                </div>


            <?php else: ?>



            <div class="table-responsive">


            <table class="table table-striped table-hover align-middle">


                <thead class="table-dark">


                    <tr>

                        <th>Date</th>

                        <th>Type</th>

                        <th>Destination</th>

                        <th>Montant</th>

                        <th>Frais</th>

                        <th>Total</th>

                    </tr>


                </thead>



                <tbody>


                <?php foreach($historique as $op): ?>





                    <tr>


                        <td>

                            <?= esc($op['date_operation']) ?>

                        </td>



                        <td>


                            <?php if($op['type_operation']=="Depot"): ?>


                                <span class="badge bg-success">
                                    💰 Dépôt
                                </span>


                            <?php elseif($op['type_operation']=="Retrait"): ?>


                                <span class="badge bg-danger">
                                    💸 Retrait
                                </span>


                            <?php else: ?>


                                <span class="badge bg-primary">
                                    🔄 Transfert
                                </span>


                            <?php endif; ?>


                        </td>



<td>
    <?php if($op['type_operation'] == "Transfert"): ?>

        <?= esc($op['telephone_destination'] ?? '-') ?>

    <?php else: ?>

        <?= esc($op['telephone_client'] ?? '-') ?>
    <?php endif; ?>
</td>


                        <td>

                            <?= number_format(
                                $op['montant'],
                                0,
                                ',',
                                ' '
                            ) ?>

                            Ar

                        </td>




                        <td>

                            <?= number_format(
                                $op['frais'],
                                0,
                                ',',
                                ' '
                            ) ?>

                            Ar

                        </td>




                        <td>

                            <?= number_format(
                                $op['montant'] + $op['frais'],
                                0,
                                ',',
                                ' '
                            ) ?>

                            Ar

                        </td>



                    </tr>



                <?php endforeach; ?>


                </tbody>



            </table>


            </div>



            <?php endif; ?>



            <div class="text-center mt-4">


                <a href="<?= base_url('client') ?>"
                   class="btn btn-secondary">

                    ⬅ Retour accueil

                </a>


            </div>



        </div>


    </div>


</div>




<script 
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>