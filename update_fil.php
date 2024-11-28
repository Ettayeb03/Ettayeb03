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

    // Traitement du formulaire
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer et sécuriser les données du formulaire
        $nombreDeGroupe = mysqli_real_escape_string($conn, $_POST['nombreDeGroupe']);
        $nom = mysqli_real_escape_string($conn, $_POST['nom']);

        // Mise à jour dans la base de données
        $sql = "UPDATE Filieres SET nom='$nom', nombreDeGroupe='$nombreDeGroupe' WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            $message = "Filière mise à jour avec succès.";
            header("Location: read_fil.php?success=" . urlencode($message));
            exit();
        } else {
            $error = "Erreur lors de la mise à jour : " . mysqli_error($conn);
        }
    }

    // Récupérer les informations actuelles de la filière
    $result = mysqli_query($conn, "SELECT * FROM Filieres WHERE id=$id");
    if (!$result || mysqli_num_rows($result) === 0) {
        die("Filière non trouvée.");
    }
    $filiere = mysqli_fetch_assoc($result);

    mysqli_close($conn);
} else {
    die("ID de la filière manquant.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une filière</title>
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
            color: rgb(11, 142, 54);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 15px;
            color: rgb(11, 142, 54);
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
    <h3>Modifier une filière</h3>
    
    <!-- Message d'erreur -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <!-- Formulaire de modification -->
    <form method="POST" action="">
        <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($filiere['nom']) ?>" placeholder="Nom" required>
        <input type="text" name="nombreDeGroupe" class="form-control" value="<?= htmlspecialchars($filiere['nombreDeGroupe']) ?>" placeholder="Nombre de groupes" required>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="read_fil.php" class="btn btn-secondary">Retour</a>
    </form>
</div>
</body>
</html>
