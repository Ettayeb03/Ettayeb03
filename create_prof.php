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
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    if (!empty($prenom) && !empty($nom) && !empty($email) && !empty($telephone) && !empty($_POST['password'])) {
        $query = "INSERT INTO Profs (prenom, nom, email, telephone, password) VALUES ('$prenom', '$nom', '$email', '$telephone', '$password')";
        if (mysqli_query($conn, $query)) {
            $message = "<div class='success'>Professeur ajouté avec succès.</div>";
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
    <title>Créer un Professeur</title>
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

        .login-container { 
            width: 400px; 
            text-align: center;
        }

        .form-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        .form-container h2 {
            color: rgb(11, 142,54); 
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            color: #555;
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
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
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
            border: none;
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
    <h2>Ajouter un Professeur</h2>

    <!-- Message de statut -->
    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <input type="text" id="prenom" name="prenom" placeholder="Prénom" required>
        </div>

        <div class="form-group">
            <input type="text" id="nom" name="nom" placeholder="Nom" required>
        </div>

        <div class="form-group">
            <input type="email" id="email" name="email" placeholder="Email" required>
        </div>

        <div class="form-group">
            <input type="tel" id="telephone" name="telephone" placeholder="Téléphone" required>
        </div>

        <div class="form-group">
            <input type="password" id="password" name="password" placeholder="Mot de passe" required>
        </div>

        <div class="button-container">
            <button type="submit">Ajouter</button>
            <a href="read_prof.php" class="btn-secondary">Retour</a>
        </div>
    </form>
</div>

</body>
</html>