<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Текстовый редактор</title>
    <script src="scripts/processCommands.js"></script>
    <script src="scripts/messages.js"></script>
</head>
<body>
    <h1>Текстовый редактор</h1>
    <form onsubmit="processCommands(); return false">
        <p>Введите одну или несколько команды построчно:</p>
        <p>
            <textarea id="commands" cols="45" rows="10"></textarea>
        </p>
        <p id="errorMessageContainer"></p>
        <p id="successMessageContainer"></p>
        <p id="resultContainer"></p>
        <button type="submit">Выполнить</button>
    </form>
</body>
</html>