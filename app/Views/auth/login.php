<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>

<body>

<h2>Connexion Mobile Money</h2>


<?php if(isset($error)): ?>

<p style="color:red">
    <?= esc($error) ?>
</p>

<?php endif; ?>


<form method="post" action="<?= base_url('login') ?>">

<?= csrf_field() ?>


<label>
    Numéro téléphone :
</label>

<br>

<input 
    type="text"
    name="telephone"
    placeholder="0341234567"
    required
>


<br><br>


<button type="submit">
    Se connecter
</button>


</form>


</body>
</html>