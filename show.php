<?php

function getTask($id) {
    $pdo = new PDO("mysql:host=localhost;dbname=tasks","root","");
    $sql = 'SELECT * FROM tasks WHERE id=:id';
    $statement = $pdo->prepare($sql);
    $statement->bindParam(":id",$id);
    $statement->execute();
    $task = $statement->fetch(PDO::FETCH_ASSOC);

    return $task;
}

$task = getTask($_GET['id']);

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?=$task['title']?></h1>
                <p><?=$task['content']?></p>
                <a href="/" class="btn btn-info">Go back</a>
            </div>
        </div>
    </div>
</body>
</html>