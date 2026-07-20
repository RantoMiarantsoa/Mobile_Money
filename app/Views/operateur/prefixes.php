<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Gestion des Préfixes</title>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
rel="stylesheet">


<link rel="stylesheet" 
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


</head>


<body class="bg-light">



<div class="d-flex">



    <!-- SIDEBAR -->

    <?= view('layout/sidebar') ?>




    <!-- CONTENU -->

    <main class="container-fluid p-4">



        <div class="d-flex justify-content-between align-items-center mb-4">


            <h2>
                🔢 Gestion des préfixes
            </h2>



            <button class="btn btn-primary">


                <i class="bi bi-plus-circle"></i>

                Ajouter un préfixe


            </button>



        </div>






        <!-- FILTRE OPERATEUR -->


        <div class="card shadow border-0 mb-4">


            <div class="card-body">


                <div class="row">


                    <div class="col-md-4">


                        <label class="form-label">

                            Opérateur

                        </label>



                        <select class="form-select">


                            <option value="">

                                Tous les opérateurs

                            </option>


                            <?php if(isset($operateurs)): ?>


                                <?php foreach($operateurs as $operateur): ?>


                                <option value="<?= esc($operateur['id']) ?>">


                                    <?= esc($operateur['nom']) ?>


                                </option>


                                <?php endforeach; ?>


                            <?php endif; ?>



                        </select>



                    </div>



                </div>



            </div>


        </div>







        <!-- TABLE PREFIXES -->


        <div class="card shadow border-0">



            <div class="card-header bg-dark text-white">


                Liste des préfixes


            </div>





            <div class="card-body">



                <table class="table table-striped table-hover">



                    <thead>


                        <tr>


                            <th>
                                ID
                            </th>


                            <th>
                                Opérateur
                            </th>


                            <th>
                                Préfixe
                            </th>


                            <th>
                                Actions
                            </th>


                        </tr>


                    </thead>






                    <tbody>



                    <?php if(!empty($prefixes)): ?>



                        <?php foreach($prefixes as $prefixe): ?>



                        <tr>



                            <td>

                                <?= esc($prefixe['id']) ?>

                            </td>





                            <td>

                                <?= esc($prefixe['operateur']) ?>

                            </td>





                            <td>


                                <span class="badge bg-primary">


                                    <?= esc($prefixe['code']) ?>


                                </span>


                            </td>







                            <td>



                                <button class="btn btn-sm btn-warning">


                                    <i class="bi bi-pencil"></i>

                                    Modifier


                                </button>





                                <button class="btn btn-sm btn-danger">


                                    <i class="bi bi-trash"></i>

                                    Supprimer


                                </button>




                            </td>





                        </tr>




                        <?php endforeach; ?>




                    <?php else: ?>



                        <tr>


                            <td colspan="4" class="text-center">


                                Aucun préfixe trouvé



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