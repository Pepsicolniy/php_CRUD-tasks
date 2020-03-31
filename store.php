<?php

//Сохранение новой задачи
function AddTask($data) {
    $pdo = new PDO("mysql:host=localhost; dbname=tasks", "root", "");
    $sql = 'INSERT INTO tasks (title,content) VALUES (:title,:content)';
    $statement = $pdo->prepare($sql);
    $statement->execute($data);

    header('Location: /'); exit;
}

AddTask($_POST);
