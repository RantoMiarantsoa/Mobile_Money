<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Accueil Mobile Money</title>


<style>

body{
    font-family: Arial;
    background:#f2f2f2;
}


.container{

    width:400px;
    margin:50px auto;
    background:white;
    padding:30px;
    border-radius:10px;
    text-align:center;

}


.solde{

    font-size:30px;
    color:green;
    margin:20px;

}


button{

    width:100%;
    padding:15px;
    margin:10px;
    border:none;
    border-radius:5px;
    font-size:18px;

}


.depot{

background:#28a745;
color:white;

}


.retrait{

background:#dc3545;
color:white;

}


.transfert{

background:#007bff;
color:white;

}


.logout{

background:#333;
color:white;

}


</style>


</head>


<body>

<pre>
<?php var_dump($solde); ?>
</pre>
<div class="container">


<h2>
Bonjour <?= esc($nom) ?>
</h2>

<h3>
    Voici votre solde : <?= esc($solde) ?> Ar
</h3>



</h3>
<p>
Téléphone :
<?= esc($telephone) ?>
</p>





<a href="<?= base_url('client/depot') ?>">

<button class="depot">

💰 Dépôt

</button>

</a>




<a href="<?= base_url('client/retrait') ?>">

<button class="retrait">

💸 Retrait

</button>

</a>





<a href="<?= base_url('client/transfert') ?>">

<button class="transfert">

🔄 Transfert

</button>

</a>

<a href="<?= base_url('client/historique') ?>">

<button class="historique">

🔍 Historique opérations

</button>

</a>


<a href="<?= base_url('logout') ?>">

<button class="logout">

🚪 Déconnexion

</button>

</a>



</div>


</body>

</html>