<?php

CONST ERROR_LOG_FILE = "ERROR_LOG_FILE.log";

    $dsn ='mysql:host=127.0.0.1;dbname=gecko';
    $username = 'hurma';
    $passwd = "492016";
    try {
        $con = new PDO($dsn, $username, $passwd);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->exec("SET CHARACTER SET utf8");
        return $con;

    } catch (PDOException $err) {
        echo "PDO ERROR --> " . $err->getMessage();
        file_put_contents(ERROR_LOG_FILE, "PDO ERROR --> " . $err, FILE_APPEND);
        return;
    }
