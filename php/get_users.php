<?php
// Подключение к базе данных
require_once 'db.php';

// Получение списка пользователей из базы данных
$stmt = $conn->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Отправка списка пользователей в формате JSON
echo json_encode($users);


?>