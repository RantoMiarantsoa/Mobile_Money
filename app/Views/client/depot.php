<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dépôt</title>
</head>

<body>

<h1>Faire un dépôt</h1>


<?php if(isset($error)): ?>

<p style="color:red">
    <?= esc($error) ?>
</p>

<?php endif; ?>


<?php if(isset($success)): ?>

<p style="color:green">
    <?= esc($success) ?>
</p>

<?php endif; ?>


<form method="post" action="<?= base_url('client/depot') ?>">


<?= csrf_field() ?>


<label>
    Montant :
</label>


<input 
    type="number"
    name="montant"
    min="1"
    required
>


<br><br>


<button type="submit">
    Déposer
</button>


</form>


<br>


<a href="<?= base_url('client') ?>">
Retour accueil
</a>


</body>
</html>