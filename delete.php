<?php

function deleteTask($id) {
    $pdo = new PDO("mysql:host=localhost;dbname=tasks","root","");
    $sql = 'DELETE FROM tasks WHERE id=:id';
    $statement = $pdo->prepare($sql);
    $statement->bindParam(":id",$id);
    $statement->execute();
    header('Location: /'); exit;
}

$id = $_GET['id'];

deleteTask($id);