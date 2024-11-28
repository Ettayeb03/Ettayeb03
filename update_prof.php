<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sécuriser l'ID reçu dans l'URL

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "emsidb";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer et sécuriser les données du formulaire
        $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);

        // Mise à jour dans la base de données
        $sql = "UPDATE Profs SET prenom='$prenom', nom='$nom', email='$email', telephone='$telephone' WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            $message = "Professeur mis à jour avec succès.";
            header("Location: read_prof.php?success=" . urlencode($message));
            exit();
        } else {
            $error = "Erreur : " . mysqli_error($conn);
        }
    }

    // Récupérer les informations du professeur
    $result = mysqli_query($conn, "SELECT * FROM Profs WHERE id=$id");
    if (!$result || mysqli_num_rows($result) === 0) {
        die("Professeur non trouvé.");
    }
    $prof = mysqli_fetch_assoc($result);

    mysqli_close($conn);
} else {
    die("ID du professeur manquant.");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Professeur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            text-align: center;
            background-color: #fff;
            color: rgb(11,142,54);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 15px;
            color: rgb(11,142,54);
        }

        .form-container .form-control {
            margin-bottom: 15px;
            font-size: 16px;
        }

        .form-container .btn {
            width: 100%;
            margin-top: 10px;
        }

        .form-container .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .form-container .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

       
    </style>
</head>
<body>
<div class="form-container">
    <img src="logoemsi.png" alt="EMSI" style="max-width: 200px;">
    <h3>Ajouter un Professeur</h3> 
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($prof['prenom']) ?>" placeholder="Prénom" required>
        <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($prof['nom']) ?>" placeholder="Nom" required>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($prof['email']) ?>" placeholder="Email" required>
        <input type="text" name="telephone" class="form-control" value="<?= htmlspecialchars($prof['telephone']) ?>" placeholder="Téléphone" required>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <button href="read_prof.php" class="btn btn-secondary">Retour</button>
    </form>
</div>
</body>
</html>
