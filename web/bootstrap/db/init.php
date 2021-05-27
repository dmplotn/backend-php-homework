<?php

$opt = [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
];

$ipAddress = '172.26.0.2';

$pdo = new \PDO("mysql:host={$ipAddress};port=3306;dbname=test;", 'root', 'root', $opt);
