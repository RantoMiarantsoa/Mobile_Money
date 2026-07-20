<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <title>Dépôt Mobile Money</title>

    <!-- Bootstrap 5 -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >

</head>


<body class="bg-light">


<div class="container">

    <div class="row justify-content-center mt-5">

        <div class="col-md-5">


            <div class="card shadow">


                <div class="card-header bg-success text-white text-center">

                    <h3>
                        💰 Faire un dépôt
                    </h3>

                </div>



                <div class="card-body">



                    <?php if(isset($error)): ?>

                    <div class="alert alert-danger">

                        <?= esc($error) ?>

                    </div>

                    <?php endif; ?>



                    <?php if(isset($success)): ?>

                    <div class="alert alert-success">

                        <?= esc($success) ?>

                    </div>

                    <?php endif; ?>




                    <form method="post" action="<?= base_url('client/depot') ?>">


                        <?= csrf_field() ?>



                        <div class="mb-3">


                            <label class="form-label">

                                Montant

                            </label>


                            <div class="input-group">


                                <input 
                                    type="number"
                                    class="form-control"
                                    name="montant"
                                    min="1"
                                    required
                                >


                                <span class="input-group-text">

                                    Ar

                                </span>


                            </div>


                        </div>




                        <button 
                            type="submit" 
                            class="btn btn-success w-100"
                        >

                            💰 Déposer

                        </button>



                    </form>



                    <div class="text-center mt-3">


                        <a 
                            href="<?= base_url('client') ?>"
                            class="btn btn-secondary"
                        >

                            ⬅ Retour accueil

                        </a>


                    </div>



                </div>


            </div>


        </div>


    </div>


</div>



<!-- Bootstrap JS -->
<script 
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>