<?php
session_start();

// 🔧 Configuration de la base MySQL (adapte selon ton XAMPP)
$host = "51.68.46.54";
$dbname = "ElevageRyan";
$username_db = "Ryan"; // par défaut dans XAMPP
$password_db = "ArchLinux59";

// Connexion PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username_db, $password_db);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base : " . $e->getMessage());
}

// Récupération du formulaire
$action = $_POST['action'] ?? '';
$username = trim($_POST['name'] ?? '');
$password = $_POST['mot_de_passe'] ?? '';

if ($action === 'register') {
    // Vérifie si l'utilisateur existe déjà
    $stmt = $pdo->prepare("SELECT id FROM users WHERE name = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        echo "❌ Ce nom d'utilisateur existe déjà.";
        exit;
    }

    // Inscription
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (name, mot_de_passe) VALUES (?, ?)");
    $stmt->execute([$username, $hash]);

    echo "✅ Inscription réussie.";
}

elseif ($action === 'login') {
    // Connexion
    $stmt = $pdo->prepare("SELECT id, mot_de_passe FROM users WHERE name = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['mot_de_passe'])) {
        $_SESSION['user'] = $username;
        header('Location: lobby.php');
        exit;
    } else {
        echo "❌ Identifiants incorrects.";
    }
}

else {
    echo "❌ Action non reconnue.";
}