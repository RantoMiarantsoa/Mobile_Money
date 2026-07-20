<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<title>Clients</title>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
rel="stylesheet">


</head>
<body class="bg-light">

<div class="d-flex">
<div id="sidebar"></div>
<main class="container-fluid p-4">

<h2>Liste des clients</h2>



<div class="card shadow mt-4">
<div class="card-body">

<table class="table table-striped">


<thead>

<tr>

<th>ID</th>
<th>Nom</th>
<th>Téléphone</th>

</tr>

</thead>



<tbody>


<?php foreach($clients as $client): ?>


<tr>

<td>
<?= $client['id'] ?>
</td>


<td>
<?= $client['nom'] ?>
</td>


<td>
<?= $client['telephone'] ?>
</td>


</tr>


<?php endforeach; ?>


</tbody>



</table>



</div>


</div>



</main>


</div>





<script>

fetch("../layout/sidebar.html")

.then(response=>response.text())

.then(data=>{

document.getElementById("sidebar").innerHTML=data;

});

</script>



</body>

</html>