<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Текстовый редактор</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="scripts/processCommands.js"></script>
    <script src="scripts/messages.js"></script>
</head>
<body class="container mx-auto w-2/5">
    <h1 class="text-4xl font-bold mt-4 mb-8">Текстовый редактор</h1>
    <form onsubmit="processCommands(); return false">
        <p class="my-4">Введите одну или несколько команды построчно:</p>
        <p>
            <textarea class="border rounded-lg p-2" id="commands" cols="47" rows="10"></textarea>
        </p>
        <p class="my-4 text-sm text-red-600" id="errorMessageContainer"></p>
        <p class="my-4 text-sm text-green-600" id="successMessageContainer"></p>
        <p class="my-4 text-sm"id="resultContainer"></p>
        <button
            class="mt-4 bg-blue-200 p-2 rounded-md hover:bg-blue-400 focus:outline-none"
            type="submit"
        >Выполнить</button>
    </form>
</body>
</html>