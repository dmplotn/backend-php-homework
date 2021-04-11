<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task3/StringExtractor.php';

use function Task3\StringExtractor\getExtractedStrings;

$extractedStrings = getExtractedStrings();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Извлечение строк</title>
</head>
<body>
    <h1>Результат извлечения</h1>
    <p>
        <pre><?php print_r($extractedStrings) ?></pre>
    </p>
</body>
</html>