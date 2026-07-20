<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Transfert</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>Transfert d'argent</h3>

</div>

<div class="card-body">

<?php

$titre = "";

switch($operateur){

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

<div class="alert alert-info">

<b>Destination :</b> <?= $titre ?>

</div>

<form method="post" action="<?= base_url('client/transfert') ?>">

<?= csrf_field() ?>

<input
type="hidden"
name="operateur"
value="<?= esc($operateur) ?>"
>

<div class="mb-3">

<label class="form-label">

Numéro destinataire

</label>

<input
type="text"
class="form-control"
name="telephoneDestinataire"
required>

</div>

<div class="mb-3">

<label class="form-label">

Montant

</label>

<input
type="number"
class="form-control"
name="montant"
min="1"
required>

</div>

<?php if($operateur=="MVOLA"): ?>

<div class="form-check mb-3">

<input
class="form-check-input"
type="checkbox"
name="ajouterRetrait"
value="1"
id="retrait">

<label
class="form-check-label"
for="retrait">

Ajouter les frais de retrait

</label>

</div>

<?php endif; ?>

<button
class="btn btn-success w-100">

Envoyer

</button>

</form>

<br>

<a href="<?= base_url('client') ?>" class="btn btn-secondary w-100">

Retour

</a>

</div>

</div>

</div>

</body>

</html>