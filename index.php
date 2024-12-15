<?php
// Початок сесії для збереження даних гри
session_start();

// Якщо форма була відправлена, обробляємо дані гравців
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Збереження імен гравців із захистом від XSS-атак
    $_SESSION['player1'] = htmlspecialchars($_POST['player1']);
    $_SESSION['player2'] = htmlspecialchars($_POST['player2']);
    
    // Ініціалізація пустого ігрового поля (масив з 9 елементів)
    $_SESSION['board'] = array_fill(0, 9, '');
    
    // Встановлення поточного гравця на Гравця 1
    $_SESSION['current_player'] = $_SESSION['player1'];
    
    // Ініціалізація рахунку для обох гравців
    $_SESSION['score'] = ['player1' => 0, 'player2' => 0];

    // Перенаправлення на сторінку з грою
    header('Location: game.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Хрестики-Нулики</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Хрестики-Нулики</h1>
        <!-- Форма для введення імен гравців -->
        <form method="POST">
            <label for="player1">Ім'я Гравця 1:</label>
            <input type="text" id="player1" name="player1" required>

            <label for="player2">Ім'я Гравця 2:</label>
            <input type="text" id="player2" name="player2" required>

            <button type="submit">Розпочати гру</button>
        </form>
    </div>
</body>
</html>