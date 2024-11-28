<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sécuriser l'ID avec une conversion en entier

    // Informations de connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "emsidb";

    // Connexion à la base de données
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Vérification de la connexion
    if (!$conn) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }

    // Requête pour supprimer la filière
    $sql = "DELETE FROM Filieres WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        // Redirection avec un message de succès
        $message = "Filière supprimée avec succès.";
        header("Location: read_fil.php?success=" . urlencode($message));
        exit();
    } else {
        // Redirection avec un message d'erreur
        $error = "Erreur lors de la suppression : " . mysqli_error($conn);
        header("Location: read_fil.php?error=" . urlencode($error));
        exit();
    }

    // Fermeture de la connexion
    mysqli_close($conn);
} else {
    // Redirection si aucun ID n'est fourni
    header("Location: read_fil.php?error=" . urlencode("ID de la filière manquant."));
    exit();
}
?>
