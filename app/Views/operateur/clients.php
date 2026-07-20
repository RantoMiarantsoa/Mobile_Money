<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Clients</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body class="bg-light">

<div class="d-flex">

<!-- SIDEBAR -->
<?= view('layout/sidebar') ?>

<main class="container-fluid p-4">

<h2 class="mb-4">Situation des comptes clients</h2>

<div class="card shadow mt-4 border-0">
<div class="card-header bg-dark text-white">
Liste des clients
</div>

<div class="card-body">

<table class="table table-striped table-hover">

<thead>
<tr>
<th>ID</th>
<th>Nom</th>
<th>Téléphone</th>

</tr>
</thead>

<tbody>

<?php if (! empty($clients)) : ?>
    <?php foreach ($clients as $client) : ?>
        <tr>
            <td><?= esc($client['id']) ?></td>
            <td><?= esc($client['nom']) ?></td>
            <td><?= esc($client['telephone']) ?></td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="4" class="text-center text-muted">Aucun client enregistré.</td>
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