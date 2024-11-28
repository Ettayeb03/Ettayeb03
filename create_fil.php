<?php
// Activer les erreurs pour débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "emsidb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérification de la connexion
if (!$conn) {
    die("La connexion a échoué : " . mysqli_connect_error());
}

// Gestion de la soumission du formulaire
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreDeGroupe = mysqli_real_escape_string($conn, $_POST['nombreDeGroupe']);
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);

    if (!empty($nom) && !empty($nombreDeGroupe)) {
        $query = "INSERT INTO Filieres (nom, nombreDeGroupe) VALUES ('$nom', '$nombreDeGroupe')";
        if (mysqli_query($conn, $query)) {
            $message = "<div class='success'>Filière ajoutée avec succès.</div>";
        } else {
            $message = "<div class='error'>Erreur lors de l'ajout : " . mysqli_error($conn) . "</div>";
        }
    } else {
        $message = "<div class='warning'>Tous les champs sont obligatoires.</div>";
    }
}

// Fermer la connexion
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une filière</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        .form-container h2 {
            color: rgb(11, 142, 54);
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            display: inline-block;
            padding: 10px 20px;
            background-color: #6c757d;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            color: #fff;
        }

        .message {
            margin-top: 15px;
            font-size: 14px;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }

        .warning {
            color: orange;
        }
    </style>
</head>
<body>

<div class="form-container">
    <img src="logoemsi.png" alt="EMSI" style="max-width: 200px;">
    <h2>Ajouter une filière</h2>

    <!-- Message de statut -->
    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST" action="" novalidate>
        <div class="form-group">
            <input type="text" id="nom" name="nom" placeholder="Nom" required>
        </div>

        <div class="form-group">
            <input type="number" id="nombreDeGroupe" name="nombreDeGroupe" placeholder="Nombre des groupes" required>
        </div>

        <div class="button-container">
            <button type="submit">Ajouter</button>
            <a href="read_fil.php" class="btn-secondary">Retour</a>
        </div>
    </form>
</div>

</body>
</html>
