<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<title>Dashboard Opérateur</title>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
rel="stylesheet">


<link rel="stylesheet" 
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>


<body class="bg-light">


<div class="d-flex">


    <!-- SIDEBAR -->
    <div id="sidebar"></div>



    <!-- CONTENU -->
    <main class="container-fluid p-4">


        <h2 class="mb-4">
            📊 Dashboard Opérateur
        </h2>



        <div class="row g-4">



            <!-- CLIENTS -->
            <div class="col-md-4">

                <div class="card shadow border-0">

                    <div class="card-body">

                        <h6 class="text-muted">
                            👥 Clients
                        </h6>


                        <h2>
                            <?= $nombreClients ?>
                        </h2>


                        <p>
                            Clients enregistrés
                        </p>


                    </div>

                </div>

            </div>





            <!-- OPERATIONS -->
            <div class="col-md-4">

                <div class="card shadow border-0">


                    <div class="card-body">

                        <h6 class="text-muted">
                            🔄 Opérations
                        </h6>


                        <h2>
                            <?= $nombreOperations ?>
                        </h2>


                        <p>
                            Toutes les opérations
                        </p>


                    </div>


                </div>

            </div>





        
            <div class="col-md-4">

                <div class="card shadow border-0">


                    <div class="card-body">


                        <h6>
                            💰 Gains retrait
                        </h6>


                        <h2 class="text-warning">

                            <?= number_format($gainRetrait,0,',',' ') ?>

                            Ar

                        </h2>


                    </div>


                </div>


            </div>






            <div class="col-md-4">


                <div class="card shadow border-0">


                    <div class="card-body">


                        <h6>
                            💸 Gains transfert
                        </h6>


                        <h2 class="text-primary">


                            <?= number_format($gainTransfert,0,',',' ') ?>

                            Ar


                        </h2>


                    </div>


                </div>


            </div>





        
            <div class="col-md-4">


                <div class="card shadow bg-success text-white">


                    <div class="card-body">


                        <h6>
                            📈 Gains total
                        </h6>


                        <h2>


                            <?= number_format($gainTotal,0,',',' ') ?>

                            Ar


                        </h2>


                        <p>
                            Retrait + Transfert
                        </p>


                    </div>


                </div>


            </div>




        </div>


    </main>


</div>





<script>

fetch("../layout/sidebar.html")

.then(response => response.text())

.then(data => {

document.getElementById("sidebar").innerHTML=data;

});


</script>


</body>

</html>