<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";

// Connexion à MySQL
$conn = mysqli_connect($servername, $username, $password);

// Vérification de la connexion
if (!$conn) {
    die("La connexion a échoué : " . mysqli_connect_error());
}
echo "Connexion réussie<br>";

// Définir le nom de la base de données
$dbname = "emsiDb";

// Vérifier si la base de données existe déjà
$query = "SHOW DATABASES LIKE '$dbname'";
$result = mysqli_query($conn, $query);

// Si la base de données n'existe pas, la créer
if (mysqli_num_rows($result) == 0) {
    $createDbQuery = "CREATE DATABASE $dbname";
    if (mysqli_query($conn, $createDbQuery)) {
        echo "Base de données '$dbname' créée avec succès.<br>";
    } else {
        die("Erreur lors de la création de la base de données : " . mysqli_error($conn));
    }
}

// Sélectionner la base de données
if (!mysqli_select_db($conn, $dbname)) {
    die("Erreur de sélection de la base de données : " . mysqli_error($conn));
}

$query = "
    CREATE TABLE Profs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(50) NOT NULL,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

    CREATE TABLE IF NOT EXISTS Modules (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
        nom VARCHAR(30) NOT NULL,
        duree TIME,
        prof_id INT(6) UNSIGNED,  
        FOREIGN KEY (prof_id) REFERENCES Profs(id) ON DELETE CASCADE  
    );

    CREATE TABLE IF NOT EXISTS Filieres (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
        nom VARCHAR(30) NOT NULL,
        nombreDeGroupe INT
    );

    CREATE TABLE IF NOT EXISTS Groupes (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        nom VARCHAR(30) NOT NULL,
        cycle VARCHAR(20),
        filiere_id INT(6) UNSIGNED,  
        prof_id INT(6) UNSIGNED,  
        FOREIGN KEY (filiere_id) REFERENCES Filieres(id) ON DELETE CASCADE,  
        FOREIGN KEY (prof_id) REFERENCES Profs(id) ON DELETE CASCADE 
    );

    CREATE TABLE IF NOT EXISTS CahierDeTextes (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
        travailDaujourdhui TEXT NOT NULL,
        module_id INT(6) UNSIGNED,  
        FOREIGN KEY (module_id) REFERENCES Modules(id) ON DELETE CASCADE  
    );
";

// Exécution de la création des tables
if (mysqli_multi_query($conn, $query)) {
    echo "Les tables ont été créées avec succès.<br>";
} else {
    echo "Erreur lors de la création des tables : " . mysqli_error($conn) . "<br>";
}

// Fermeture de la connexion
mysqli_close($conn);
?>
