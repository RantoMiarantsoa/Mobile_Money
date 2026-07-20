<!DOCTYPE html>
<html>
<head>
<title>Transfert</title>
</head>

<body>

<h1>Effectuer un transfert</h1>


<form method="post" action="<?= base_url('client/transfert') ?>">


<?= csrf_field() ?>


<label>
Numéro destinataire :
</label>

<input 
type="text"
name="telephoneDestinataire"
required
>


<br><br>


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
Envoyer
</button>


</form>


</body>
</html>