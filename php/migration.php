<?php
require_once 'db.php';

try {
    // Создание таблицы ролей
    $sql_roles = "CREATE TABLE roles (
        id INT AUTO_INCREMENT PRIMARY KEY,
        role_name VARCHAR(50) UNIQUE NOT NULL
    )";
    $conn->exec($sql_roles);
    echo "Таблица ролей успешно создана\n"; 

    // Заполнение таблицы ролей начальными данными
    $initial_roles = [
        "Админ",
        "Пользователь",
    ];

    foreach ($initial_roles as $role_name) {
        $stmt = $conn->prepare("INSERT INTO roles (role_name) VALUES (:role_name)");
        $stmt->bindParam(':role_name', $role_name);
        $stmt->execute();
    }

    echo "Данные успешно добавлены в таблицу ролей\n";

    // Создание таблицы пользователей
    $sql_users = "CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(100) NOT NULL,
        login VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        role_id INT NOT NULL,
        is_blocked BOOLEAN NOT NULL DEFAULT 0,
        FOREIGN KEY (role_id) REFERENCES roles(id)
    )";
    $conn->exec($sql_users);
    echo "Таблица пользователей успешно создана\n";
    
} catch(PDOException $e) {
    echo $e->getMessage();
}

$conn = null;
?>

