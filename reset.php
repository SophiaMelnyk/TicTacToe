<?php
// Початок сесії
session_start();

// Завершення сесії та очищення всіх даних
session_destroy();

// Перенаправлення користувача на головну сторінку (index.php)
header('Location: index.php');
exit;
?>