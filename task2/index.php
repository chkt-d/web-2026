<?php include 'NumbersInWords.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Цифры</title>
</head>
<body>

    <form method="POST">
        <label for="digit">Введите цифру (0-9):</label>
        <input type="number" name="digit" id="digit" min="0" max="9" required>
        <button type="submit">Преобразовать</button>
    </form>

    <?php if ($operationResult): ?>
        <h3><?=$operationResult['value']?></h3>
    <?php endif; ?>
    
</body>
</html>