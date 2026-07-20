<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Gestion des Barèmes</title>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
rel="stylesheet">


<link rel="stylesheet" 
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


</head>



<body class="bg-light">



<div class="d-flex">



    <!-- SIDEBAR -->

    <div style="width:260px;">

        <?= view('layout/sidebar') ?>

    </div>





    <!-- CONTENU -->

    <main class="container-fluid p-4">



        <div class="d-flex justify-content-between align-items-center mb-4">


            <h2>
                 Gestion des barèmes de frais
            </h2>




            <button class="btn btn-primary">


                <i class="bi bi-plus-circle"></i>

                Ajouter un barème


            </button>



        </div>






        <div class="card shadow border-0">



            <div class="card-header bg-dark text-white">


                Liste des barèmes


            </div>





            <div class="card-body">



                <table class="table table-striped table-hover">



                    <thead>


                        <tr>


                            <th>
                                Type opération
                            </th>


                            <th>
                                Montant minimum
                            </th>


                            <th>
                                Montant maximum
                            </th>


                            <th>
                                Frais
                            </th>


                            <th>
                                Actions
                            </th>


                        </tr>


                    </thead>







                    <tbody>



                    <?php if(!empty($baremes)): ?>



                        <?php foreach($baremes as $bareme): ?>



                        <tr>



                            <td>

                                <?= esc($bareme['type_operation']) ?>

                            </td>




                            <td>

                                <?= esc($bareme['montant_min']) ?> Ar

                            </td>




                            <td>

                                <?= esc($bareme['montant_max']) ?> Ar

                            </td>




                            <td>

                                <?= esc($bareme['frais']) ?> Ar

                            </td>





                            <td>



                                <button class="btn btn-warning btn-sm">


                                    <i class="bi bi-pencil"></i>

                                    Modifier


                                </button>





                                <button class="btn btn-danger btn-sm">


                                    <i class="bi bi-trash"></i>

                                    Supprimer


                                </button>



                            </td>




                        </tr>




                        <?php endforeach; ?>




                    <?php else: ?>



                        <tr>


                            <td colspan="5" class="text-center">


                                Aucun barème trouvé


                            </td>


                        </tr>



                    <?php endif; ?>



                    </tbody>



                </table>



            </div>



        </div>




    </main>




</div>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



</body>


</html>