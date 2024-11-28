<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "emsidb";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }

    $sql = "DELETE FROM Profs WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "Professeur supprimé avec succès.";
    } else {
        echo "Erreur : " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
