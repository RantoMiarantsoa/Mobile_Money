<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Situation des gains</title>

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

<h2 class="mb-4">📈 Situation des gains</h2>

<div class="row g-4">

<div class="col-md-4">
<div class="card shadow border-0">
<div class="card-body">
<h5>💰 Gains retrait</h5>
<h2 class="text-warning">
<?= number_format($gainRetrait, 0, ',', ' ') ?> Ar
</h2>
<p>Total frais provenant des retraits</p>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card shadow border-0">
<div class="card-body">
<h5>💸 Gains transfert</h5>
<h2 class="text-primary">
<?= number_format($gainTransfert, 0, ',', ' ') ?> Ar
</h2>
<p>Total frais provenant des transferts</p>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card shadow bg-success text-white">
<div class="card-body">
<h5>📊 Gains total</h5>
<h2>
<?= number_format($gainTotal, 0, ',', ' ') ?> Ar
</h2>
<p>Retrait + Transfert</p>
</div>
</div>
</div>

</div>

</main>

</div>

</body>
</html>