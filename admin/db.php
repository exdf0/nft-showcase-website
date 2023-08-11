<?php
    $ip = "localhost";
    $user = "root";
    $password = "";
    $db = "newname";

    try {
        $db = new PDO("mysql:host=$ip;dbname=$db", $user, $password, array(PDO::FETCH_ASSOC));
        $db->exec("SET CHARSET UTF8");
    } catch (PDOException $e) {
        die("Veritabanı Hatası Var");
    }
