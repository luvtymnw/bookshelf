<?php
// Устанавливаем кодировку
header('Content-Type: text/html; charset=utf-8');

// Параметры подключения к базе данных
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'book_shelf';

// Подключение к базе данных
$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Проверка соединения
if (!$connection) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

// Устанавливаем кодировку соединения
mysqli_set_charset($connection, "utf8");

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем и очищаем данные
    $name = mysqli_real_escape_string($connection, trim($_POST['name']));
    $email = mysqli_real_escape_string($connection, trim($_POST['email']));
    $message = mysqli_real_escape_string($connection, trim($_POST['message']));
    
    // Проверяем обязательные поля
    if (empty($name) || empty($email) || empty($message)) {
        echo "Все поля обязательны для заполнения.";
        exit;
    }
    
    // Проверяем email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Пожалуйста, введите корректный email адрес.";
        exit;
    }
    
    // SQL запрос для вставки данных
    $query = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";
    
    if (mysqli_query($connection, $query)) {
        // Перенаправляем на страницу с сообщением об успехе
        header('Location: contact.html?status=success');
        exit;
    } else {
        echo "Ошибка: " . mysqli_error($connection);
    }
}

// Закрываем соединение
mysqli_close($connection);
?>