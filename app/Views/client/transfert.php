<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Transfert — Mobile Money</title>


    <!-- Google Fonts -->
    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >


    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <!-- CSS personnalisé -->
    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/style.css') ?>"
    >

</head>


<body>


<div class="simple-form-shell">

    <div class="simple-form-card">

        <div class="card">


            <!-- ============================= -->
            <!-- HEADER -->
            <!-- ============================= -->

            <div class="card-header bg-primary text-white text-center py-3">

                <i class="bi bi-send-fill fs-4 d-block mb-1"></i>

                <h3 class="h5 mb-0">
                    Transfert d'argent
                </h3>

            </div>


            <!-- ============================= -->
            <!-- BODY -->
            <!-- ============================= -->

            <div class="card-body p-4">


                <?php

                $titre = "";

                switch ($operateur) {

                    case "MVOLA":

                        $titre = "MVola";

                        break;


                    case "ORANGE":

                        $titre = "Orange Money";

                        break;


                    case "AIRTEL":

                        $titre = "Airtel Money";

                        break;


                    default:

                        $titre = "Inconnu";

                }

                ?>


                <!-- ============================= -->
                <!-- DESTINATION -->
                <!-- ============================= -->

                <div class="alert alert-info d-flex align-items-center">

                    <i class="bi bi-info-circle-fill me-2"></i>

                    <span>

                        <b>Destination :</b>

                        <?= esc($titre) ?>

                    </span>

                </div>


                <!-- ============================= -->
                <!-- FORMULAIRE -->
                <!-- ============================= -->

                <form
                    method="post"
                    action="<?= base_url('client/transfert') ?>"
                >


                    <?= csrf_field() ?>


                    <!-- Opérateur -->
                    <input
                        type="hidden"
                        name="operateur"
                        value="<?= esc($operateur) ?>"
                    >


                    <!-- ================================= -->
                    <!-- CAS MVOLA -->
                    <!-- ================================= -->

                    <?php if ($operateur === "MVOLA"): ?>


                        <!-- ============================= -->
                        <!-- NUMEROS DESTINATAIRES -->
                        <!-- ============================= -->

                        <div class="mb-3">

                            <label class="form-label">

                                Numéro destinataire

                            </label>


                            <div id="listeTelephones">


                                <!-- Premier numéro -->

                                <div
                                    class="input-group mb-2 telephone-row"
                                >

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="telephones[]"
                                        placeholder="034 12 345 67"
                                        required
                                    >


                                    <!-- Bouton + -->

                                    <button
                                        type="button"
                                        class="btn btn-success ajouterTelephone"
                                        title="Ajouter un numéro"
                                    >

                                        <i
                                            class="bi bi-plus-lg"
                                        ></i>

                                    </button>

                                </div>


                            </div>

                        </div>


                        <!-- ============================= -->
                        <!-- FRAIS DE RETRAIT -->
                        <!-- ============================= -->

                     <div class="form-check mb-3">
    <input
        class="form-check-input"
        type="checkbox"
        name="ajouterRetrait"
        value="1"
        id="retrait"
    >

    <label class="form-check-label" for="retrait">
        Ajouter les frais de retrait
    </label>
</div>

                    <!-- ================================= -->
                    <!-- AUTRES OPERATEURS -->
                    <!-- ================================= -->

                    <?php else: ?>


                        <!-- ============================= -->
                        <!-- NUMERO DESTINATAIRE -->
                        <!-- ============================= -->

                        <div class="mb-3">

                            <label class="form-label">

                                Numéro destinataire

                            </label>


                            <input
                                type="text"
                                class="form-control"
                                name="telephoneDestinataire"
                                placeholder="034 12 345 67"
                                required
                            >

                        </div>


                    <?php endif; ?>


                    <!-- ============================= -->
                    <!-- MONTANT -->
                    <!-- ============================= -->

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
                                placeholder="0"
                                required
                            >


                            <span class="input-group-text">

                                Ar

                            </span>


                        </div>

                    </div>


                    <!-- ============================= -->
                    <!-- BOUTON ENVOYER -->
                    <!-- ============================= -->

                    <button
                        type="submit"
                        class="btn btn-primary w-100"
                    >

                        <i
                            class="bi bi-send-check-fill me-1"
                        ></i>

                        Envoyer

                    </button>


                </form>


                <!-- ============================= -->
                <!-- RETOUR -->
                <!-- ============================= -->

                <div class="text-center mt-3">

                    <a
                        href="<?= base_url('client/transfert') ?>"
                        class="btn btn-secondary w-100"
                    >

                        <i
                            class="bi bi-arrow-left me-1"
                        ></i>

                        Retour

                    </a>

                </div>


            </div>

        </div>

    </div>

</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


<script src="<?= base_url('assets/js/numero.js') ?>"></script>



</body>

</html>