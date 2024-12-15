<?php
// Можливі виграшні комбінації (рядки, стовпці, діагоналі)
$winning_combinations = [
    [0, 1, 2], [3, 4, 5], [6, 7, 8], // Рядки
    [0, 3, 6], [1, 4, 7], [2, 5, 8], // Стовпці
    [0, 4, 8], [2, 4, 6]             // Діагоналі
];

// Перевірка кожної виграшної комбінації
foreach ($winning_combinations as $combination) {
    [$a, $b, $c] = $combination;
    // Якщо всі три клітинки у комбінації мають однаковий символ (X або O)
    if ($_SESSION['board'][$a] && $_SESSION['board'][$a] === $_SESSION['board'][$b] && $_SESSION['board'][$a] === $_SESSION['board'][$c]) {
        // Визначення переможця на основі символу (X - Гравець 1, O - Гравець 2)
        $winner = ($_SESSION['board'][$a] === 'X') ? 'player1' : 'player2';
        // Оновлення рахунку переможця
        $_SESSION['score'][$winner]++;
        // Виведення повідомлення про переможця
        echo "<script>alert('Переможець: " . $_SESSION[$winner] . "');</script>";
        // Скидання ігрового поля для нової гри
        $_SESSION['board'] = array_fill(0, 9, '');
        break;
    }
}

// Перевірка на нічию (усі клітинки заповнені, але переможця немає)
if (!in_array('', $_SESSION['board'], true)) {
    echo "<script>alert('Нічия!');</script>";
    // Скидання ігрового поля для нової гри
    $_SESSION['board'] = array_fill(0, 9, '');
}
?>