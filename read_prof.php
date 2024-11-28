<?php 
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "emsidb";

// Connexion à MySQL
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérification de la connexion
if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Récupérer les données des professeurs
$query = "SELECT id, prenom, nom, email, telephone FROM Profs";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("<div class='alert alert-danger'>Erreur dans la récupération des données : " . mysqli_error($conn) . "</div>");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Liste des Professeurs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container my-5">
    <h2>Liste des Professeurs</h2>
    <a class="btn btn-primary mb-3" href="create_prof.php" role="button">Ajouter un Professeur</a>

    <table class="table table-bordered table-striped">
       <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Prénom</th>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Téléphone</th>
            <th scope="col">Action</th>
        </tr>
       </thead>
       <tbody>
       <?php if ($result && mysqli_num_rows($result) > 0): ?>
           <?php while ($row = mysqli_fetch_assoc($result)): ?>
               <tr>
                   <td><?php echo htmlspecialchars($row['id']); ?></td>
                   <td><?php echo htmlspecialchars($row['prenom']); ?></td>
                   <td><?php echo htmlspecialchars($row['nom']); ?></td>
                   <td><?php echo htmlspecialchars($row['email']); ?></td>
                   <td><?php echo htmlspecialchars($row['telephone']); ?></td>
                   <td>
                       <a class="btn btn-warning btn-sm" href="update_prof.php?id=<?php echo $row['id']; ?>">Modifier</a> 
                       <a class="btn btn-danger btn-sm" href="delete_prof.php?id=<?php echo $row['id']; ?>">Supprimer</a>
                   </td>
               </tr>
           <?php endwhile; ?>
       <?php else: ?>
           <tr>
               <td colspan="6" class="text-center">Aucun professeur trouvé.</td>
           </tr>
       <?php endif; ?>

       <?php
       // Fermer la connexion à la base de données
       mysqli_close($conn);
       ?>
       </tbody>
    </table>
</div>

</body>
</html>
