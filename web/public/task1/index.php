<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';

use Task1\FigurePool;
use Task1\Figures\{Circle, Rectangle, Cuboid, Sphere};

$pool = new FigurePool();

$pool->release(new Circle(5));
$pool->release(new Sphere(7));
$pool->release(new Cuboid(10, 15, 20));
$pool->release(new Rectangle(10, 17));

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пул объектов</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="container mx-auto w-2/5">
    <h1 class="text-4xl font-bold mt-4 mb-8">Пул объектов</h1>
    <h2 class="text-2xl font-bold my-4">Содежимое пула объектов:</h2>
    <?php foreach ($pool as $figure) : ?>
        <p class="mb-4">
            <pre><?php print_r($figure) ?></pre>
        </p>
    <?php endforeach; ?>
</body>
</html>