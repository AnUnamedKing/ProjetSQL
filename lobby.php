<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscryption Store - Lobby</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="navbar">
        <div class="logo-container">
            <img src="img/title.png" alt="Inscryption Store" class="main-title-img">
        </div>
        <div style="color: #ff9900;">Joueur : <?php echo htmlspecialchars($_SESSION['user']); ?></div>
    </header>
    <main class="table-area">
        <div class="product-grid">
            <a href="https://www.amazon.fr" target="_blank" class="card">
                <div class="card-contents">
                    <div class="product-slot">
                        <img src="" class="product-img">
                    </div>
                    <div class="text-slot">
                        <h3 class="sql-name">Exemple Produit</h3>
                        <p class="sql-price">99 bones</p>
                    </div>
                </div>
            </a>
        </div>
    </main>
</body>
</html>