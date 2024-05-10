<?php
// Подключение к базе данных
require_once 'db.php';
// Получение данных из POST-запроса
$full_name = $_POST['full_name'];
$login = $_POST['login'];
$password = $_POST['password'];
$role_id = $_POST['role_id'];
$is_blocked = ($_POST['is_blocked'] == 1) ? 1 : 0;

// Запрос на добавление нового пользователя
$stmt = $conn->prepare("INSERT INTO users (full_name, login, password, role_id, is_blocked) VALUES (:full_name, :login, :password, :role_id, :is_blocked)");
$stmt->bindParam(':full_name', $full_name);
$stmt->bindParam(':login', $login);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':role_id', $role_id);
$stmt->bindParam(':is_blocked', $is_blocked);

// Выполнение запроса
if ($stmt->execute()) {
    // Если пользователь успешно добавлен, отправляем ответ в формате JSON
    echo json_encode(array('success' => true));
} else {
    // Если произошла ошибка при добавлении пользователя, отправляем сообщение об ошибке
    echo json_encode(array('error' => 'Ошибка при создании пользователя'));
}
?>
