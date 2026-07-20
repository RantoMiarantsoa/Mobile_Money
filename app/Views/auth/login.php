<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Connexion Mobile Money</title>


<link 
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet"
>


</head>


<body class="bg-light">


<div class="container">


    <div class="row justify-content-center mt-5">


        <div class="col-md-5">


            <div class="card shadow-lg border-0 rounded-4">


                <div class="card-body p-5">



                    <h2 class="text-center mb-4">

                        📱 Connexion Mobile Money

                    </h2>



                    <?php if(isset($error)): ?>


                    <div class="alert alert-danger text-center">

                        <?= esc($error) ?>

                    </div>


                    <?php endif; ?>




                    <form method="post" action="<?= base_url('login') ?>">



                        <?= csrf_field() ?>



                        <div class="mb-3">


                            <label class="form-label">

                                Numéro téléphone

                            </label>



                            <input 
                                type="text"
                                name="telephone"
                                class="form-control form-control-lg"
                                placeholder="0341234567"
                                required
                            >


                        </div>





                        <div class="d-grid">


                            <button 
                                type="submit"
                                class="btn btn-primary btn-lg rounded-3"
                            >

                                🔐 Se connecter

                            </button>


                        </div>



                    </form>



                </div>


            </div>


        </div>


    </div>


</div>



<script 
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>