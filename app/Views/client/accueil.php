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
    margin:10px 0;
    border:none;
    border-radius:5px;
    font-size:18px;
    cursor:pointer;
}

.depot{
    background:#28a745;
    color:white;
}

.retrait{
    background:#dc3545;
    color:white;
}

.transfert-mvola{
    background:#007bff;
    color:white;
}

.transfert-orange{
    background:#ff7900;
    color:white;
}

.transfert-airtel{
    background:#d50000;
    color:white;
}

.historique{
    background:#6c757d;
    color:white;
}

.logout{
    background:#333;
    color:white;
}

</style>

</head>

<body>

<div class="container">

<h2>
Bonjour <?= esc($nom) ?>
</h2>

<h3>
Votre solde : <?= esc($solde) ?> Ar
</h3>

<p>
Téléphone : <?= esc($telephone) ?>
</p>

<a href="<?= base_url('client/depot') ?>">
    <button class="depot">
         Dépôt
    </button>
</a>

<a href="<?= base_url('client/retrait') ?>">
    <button class="retrait">
         Retrait
    </button>
</a>

<hr>

<h3>Transfert d'argent</h3>

<a href="<?= base_url('client/transfert?operateur=MVOLA') ?>">
    <button class="transfert">
         Transfert vers MVola
    </button>
</a>

<a href="<?= base_url('client/transfert?operateur=ORANGE') ?>">
    <button class="transfert">
        Transfert vers Orange Money
    </button>
</a>

<a href="<?= base_url('client/transfert?operateur=AIRTEL') ?>">
    <button class="transfert">
         Transfert vers Airtel Money
    </button>
</a>

<hr>

<a href="<?= base_url('client/historique') ?>">
    <button class="historique">
         Historique des opérations
    </button>
</a>

<a href="<?= base_url('logout') ?>">
    <button class="logout">
         Déconnexion
    </button>
</a>

</div>

</body>

</html>