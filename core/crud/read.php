<?php

class Read extends Database
{

    function select($item, $id)
    {
        $conn = self::connect();

        //ищу карточку в БД по ИД
        // $sql = "SELECT * FROM `users` WHERE `id` = :id";
        $sql = "SELECT * FROM $item  WHERE `id` = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // $stmt->bindParam(':item', $item, PDO::PARAM_STR);
        $stmt->execute();

        //получаю массив с ИД
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }


    // /* Выполнение запроса с привязкой PHP-переменных */
    // $calories = 150;
    // $colour = 'red';
    // $sth = $dbh->prepare('SELECT name, colour, calories
    //     FROM fruit
    //     WHERE calories < :calories AND colour = :colour');
    // $sth->bindParam('calories', $calories, PDO::PARAM_INT);
    // /* Имена также могут начинаться с двоеточия ":" (необязательно) */
    // $sth->bindParam(':colour', $colour, PDO::PARAM_STR);
    // $sth->execute();

}