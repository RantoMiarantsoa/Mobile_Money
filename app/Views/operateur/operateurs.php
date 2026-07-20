<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">
<title>Opérateurs</title>

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
 Gestion des opérateurs
</h2>


<button class="btn btn-success mb-3">
    Ajouter opérateur
</button>



<div class="card shadow border-0">

<div class="card-body">


<table class="table table-striped">

<thead>

<tr>
<th>ID</th>
<th>Nom</th>
<th>Action</th>
</tr>

</thead>


<tbody>


<?php foreach($operateurs as $operateur): ?>

<tr>

<td>
<?= esc($operateur['id']) ?>
</td>


<td>
<?= esc($operateur['nom']) ?>
</td>


<td>

<button class="btn btn-warning">
Modifier
</button>

<button class="btn btn-danger">
Supprimer
</button>

</td>

</tr>


<?php endforeach; ?>


</tbody>


</table>


</div>

</div>


</main>


</div>


</body>
</html>