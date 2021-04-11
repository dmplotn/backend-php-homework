<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task2/Cities.php';

use function Task2\Cities\getSortedCities;

$sortedCities = getSortedCities();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Сортировка городов</title>
</head>
<body>
    <h1>Результат сортировки</h1>
    <p>
        <pre><?php print_r($sortedCities) ?></pre>
    </p>
</body>
</html>
