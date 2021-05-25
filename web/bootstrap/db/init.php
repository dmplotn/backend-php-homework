<?php

$opt = [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
];

$pdo = new \PDO('mysql:host=172.20.0.3;port=3306;dbname=test;', 'root', 'root', $opt);
