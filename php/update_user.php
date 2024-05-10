<?php
// Подключение к базе данных
require_once 'db.php';

// Получение данных из POST-запроса
$id = $_POST['id']; // Идентификатор пользователя, которого нужно обновить
$full_name = $_POST['full_name'];
$login = $_POST['login'];
$password = $_POST['password'];
$role_id = $_POST['role_id'];
$is_blocked = ($_POST['is_blocked'] == 1) ? 1 : 0;

// Запрос на обновление данных пользователя
$stmt = $conn->prepare("UPDATE users SET full_name = :full_name, login = :login, password = :password, role_id = :role_id, is_blocked = :is_blocked WHERE id = :id");
$stmt->bindParam(':full_name', $full_name);
$stmt->bindParam(':login', $login);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':role_id', $role_id);
$stmt->bindParam(':is_blocked', $is_blocked);
$stmt->bindParam(':id', $id);

// Выполнение запроса
if ($stmt->execute()) {
    // Если данные пользователя успешно обновлены, отправляем ответ в формате JSON
    echo json_encode(array('success' => true));
} else {
    // Если произошла ошибка при обновлении данных пользователя, отправляем сообщение об ошибке
    echo json_encode(array('error' => 'Ошибка при обновлении данных пользователя'));
}
?>
