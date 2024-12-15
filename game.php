<?php
session_start();

// Перевірка, чи гравці ввели імена. Якщо ні, повертаємо на головну сторінку.
if (!isset($_SESSION['player1']) || !isset($_SESSION['player2'])) {
    header('Location: index.php');
    exit;
}

// Логіка обробки ходу гравця
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $position = intval($_POST['position']); // Отримання позиції клітинки

    // Перевірка, чи клітинка ще не зайнята
    if ($_SESSION['board'][$position] === '') {
        // Встановлюємо "X" або "O" в залежності від поточного гравця
        $_SESSION['board'][$position] = ($_SESSION['current_player'] === $_SESSION['player1']) ? 'X' : 'O';

        // Зміна активного гравця
        $_SESSION['current_player'] = ($_SESSION['current_player'] === $_SESSION['player1']) ? $_SESSION['player2'] : $_SESSION['player1'];
    }

    // Включаємо файл перевірки переможця
    include 'check_winner.php';
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
        <!-- Виведення імені поточного гравця -->
        <h2>Ходить гравець: <?php echo $_SESSION['current_player']; ?></h2>

        <!-- Ігрова дошка -->
        <form method="POST">
            <div class="board">
                <?php for ($i = 0; $i < 9; $i++): ?>
                    <button name="position" value="<?php echo $i; ?>" <?php echo $_SESSION['board'][$i] ? 'disabled' : ''; ?>>
                        <?php echo $_SESSION['board'][$i]; // Виведення "X" або "O", якщо клітинка зайнята ?>
                    </button>
                <?php endfor; ?>
            </div>
        </form>

        <!-- Виведення поточного рахунку -->
        <div class="score">
            <p><?php echo $_SESSION['player1']; ?> (X): <?php echo $_SESSION['score']['player1']; ?></p>
            <p><?php echo $_SESSION['player2']; ?> (O): <?php echo $_SESSION['score']['player2']; ?></p>
        </div>

        <!-- Кнопка для завершення гри і скидання даних -->
        <a href="reset.php" class="reset-btn">Завершити гру</a>
    </div>
</body>
</html>