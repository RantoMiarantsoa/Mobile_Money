<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<title>Situation comptes clients</title>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">


<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


</head>


<body class="bg-light">


<div class="d-flex">


<?= view('layout/sidebar') ?>



<main class="container-fluid p-4">


<h2 class="mb-4">

💳 Situation des comptes clients

</h2>




<div class="card shadow border-0">


<div class="card-header bg-dark text-white">

Liste des comptes clients

</div>



<div class="card-body">



<table class="table table-striped">


<thead>

<tr>

<th>ID</th>

<th>Nom</th>

<th>Téléphone</th>

<th>Opérateur</th>

<th>Solde</th>



</tr>

</thead>



<tbody>


<?php if(!empty($comptes)): ?>


<?php foreach($comptes as $compte): ?>


<tr>


<td>

<?= esc($compte['id_client']) ?>

</td>


<td>

<?= esc($compte['nom']) ?>

</td>


<td>

<?= esc($compte['telephone']) ?>

</td>

<td>
    <?= esc($compte['operateur']) ?>
</td>


<td>

<?= esc($compte['solde']) ?> Ar

</td>


</tr>


<?php endforeach; ?>


<?php else: ?>


<tr>

<td colspan="4" class="text-center">

Aucun compte trouvé

</td>

</tr>


<?php endif; ?>


</tbody>


</table>



</div>


</div>


</main>


</div>


</body>

</html>