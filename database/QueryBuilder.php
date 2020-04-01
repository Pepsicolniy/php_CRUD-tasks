<?php

class QueryBuilder
{
    public $pdo;

    function __construct()
    {
        //connect to DB
        $this->pdo = new PDO("mysql:host=localhost;dbname=tasks", "root", "");
    }

    //Список задач
    function all($table)
    {


        $sql = "SELECT * FROM $table";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }


    //Вывод одной задачи
    function getOne($table, $id)
    {

        $sql = "SELECT * FROM $table WHERE id=:id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    //Удалить задачу
    function delete($table, $id)
    {
        $sql = "DELETE FROM $table WHERE id=:id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
        header('Location: /');
        exit;
    }


    //Обновить\Изменить задачу
    function update($table, $data)
    {
        $fields = '';

        foreach($data as $key => $value) {
            $fields .= $key . "=:" . $key . ",";
        }
        $fields = rtrim($fields,',');

        $sql = "UPDATE $table SET $fields WHERE id=:id";

        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);

    }

    //Добавить задачу
    function store($table, $data)
    {
        //1. Ключи массива
        $keys = array_keys($data);
        //2. Сформировать строку
        $stringOfKeys = implode(',', $keys);
        //3. Сформировать метки
        $placeHolders = ':' . implode(', :', $keys);

        $sql = "INSERT INTO $table ($stringOfKeys) VALUES ($placeHolders)";

        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }
}