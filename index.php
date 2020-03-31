<?php

function GetAllTasks() {

    $pdo = new PDO("mysql:host=localhost;dbname=tasks","root","");
    $sql = 'SELECT * FROM tasks';
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $tasks;
};

$tasks = GetAllTasks();

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tasks</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>All tasks</h1>
                <a href="create.php" class="btn btn-success">Add task</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($tasks as $task):?>
                        <tr>
                            <td><?=$task['id']?></td>
                            <td><?=$task['title']?></td>
                            <td>
                                <a href="show.php?id=<?=$task['id']?>" class="btn btn-info">Show</a>
                                <a href="edit.php?id=<?=$task['id']?>" class="btn btn-warning">Edit </a>
                                <a onclick="return confirm('are you sure?')" href="delete.php?id=<?=$task['id']?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>