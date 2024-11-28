<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email']; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil - EMSI</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>

<div class="navbar">
    <div class="logo">
        <img src="logoemsi.png" alt="EMSI">
    </div>
    
    <div class="menu">
        <a href="modules.php">Modules</a>
        <a href="groupes.php">Groupes</a>
        <a href="filieres.php">Filieres</a>
        <a href="cahiersDeTexte.php">Cahiers de texte</a>
        <a href="admin.php">Administration</a>
    </div>

    <div class="welcome-message">
        <span>Bonjour, <?php echo $email; ?></span>
    </div>

    <form action="logout.php" method="post">
        <button type="submit" class="logout-btn">Se déconnecter</button>
    </form>
</div>

<div class="main-content">
    <h1>Bienvenue sur le portail EMSI</h1>
    
    
</div>

</body>
</html>
