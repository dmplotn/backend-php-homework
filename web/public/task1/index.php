<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload.php';

const SERVER_ADDRESS = '172.18.0.2';

session_start();

if (isset($_GET['ip'])) {
    ['ip' => $ip] = $_GET;

    try {
        $trimmedIp = trim($ip);
        $resolver = new Resolver(SERVER_ADDRESS);
        $resultMessage = $resolver->resolve(trim($trimmedIp));
    } catch (ResolvingException $e) {
        $errorMessage = 'При запросе возникла ошибка';
    } catch (ValidationException $e) {
        $errorMessage = 'Введен некорректный ip адрес';
    }
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Получить название города по IP-адресу</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <main class="container mx-auto w-2/5">
        <h1 class="text-4xl font-bold mt-5 mb-10">Получить название города по IP-адресу</h1>
        <form class="mx-auto" action="/task1/index.php">
            <div class="mb-4">
                <p class="mb-3">
                    <label for="ip">IP-адрес:</label>
                </p>
                <p>
                    <input class="border-2 border-gray-300" type="text" id="ip" name="ip">
                </p>
            </div>
            <p class="mb-4">
                <button
                    class="bg-blue-200 p-2 rounded-md hover:bg-blue-400 focus:outline-none"
                    type="submit">Получить
                </button>
            </p>
            <?php if (isset($resultMessage)) : ?>
                <p class="text-sm text-green-600"><?= $resultMessage ?></p>
            <?php endif; ?>
            <?php if (isset($errorMessage)) : ?>
                <p class="text-sm text-red-600"><?= $errorMessage ?></p>
            <?php endif; ?>
        </form>
    </main>
</body>
</html>
