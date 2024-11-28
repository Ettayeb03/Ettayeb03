<?php
session_start();

$emailError = $passwordError = $errorMsg = "";
$emailValue = "";
$passwordValue = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailValue = $_POST["email"];
    $passwordValue = $_POST["password"];

    if (!preg_match("/\w+@emsi-edu\.ma$/", $emailValue)) {
        $emailError = "L'email doit se terminer par @emsi-edu.ma.";
    }

    if (!preg_match("/[A-Z]/", $passwordValue) || !preg_match("/[a-z]/", $passwordValue) || !preg_match("/\d/", $passwordValue)) {
        $passwordError = "Le mot de passe doit contenir une majuscule, une minuscule et un chiffre.";
    }

    if (empty($emailError) && empty($passwordError)) {
        $_SESSION['email'] = $emailValue;  
        header("Location: home.php");  
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - EMSI</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="login-container">
    <div class="logo">
        <img src="logoemsi.png" alt="EMSI" style="max-width: 200px;">
    </div>

    <h2 class="h2">Se connecter</h2>

    <form method="POST" action="login.php">
        <input type="email" name="email" class="form-input" placeholder="Email" value="<?php echo htmlspecialchars($emailValue); ?>" required>
        <span class="error"><?php echo $emailError; ?></span>

        <input type="password" name="password" class="form-input" placeholder="Mot de passe" required>
        <span class="error"><?php echo $passwordError; ?></span>

        <?php if (!empty($errorMsg)): ?>
            <div class="error"><?php echo $errorMsg; ?></div>
        <?php endif; ?>

        <button type="submit" class="login-btn">Se connecter</button>
    </form>

</div>

</body>
</html>
