<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Gain autres opérateurs</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body class="bg-light">


<div class="container mt-5">


<div class="card shadow">


<div class="card-header bg-primary text-white text-center">

<h3 class="mb-0">
 Situation gain autres opérateurs
</h3>

</div>



<div class="card-body">



<table class="table table-bordered table-hover align-middle text-center">


<thead class="table-dark">

<tr>

<th>
Opérateur
</th>

<th>
Gain commission
</th>

</tr>

</thead>



<tbody>


<?php if(!empty($gains)): ?>


<?php foreach($gains as $gain): ?>


<tr>


<td>

<?= esc($gain['operateur']) ?>

</td>



<td class="fw-bold text-success">

<?= number_format($gain['gain'],0,',',' ') ?> Ar

</td>


</tr>


<?php endforeach; ?>



<?php else: ?>


<tr>

<td colspan="2" class="text-muted">

Aucune commission enregistrée

</td>

</tr>


<?php endif; ?>


</tbody>


</table>



</div>


</div>


</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>