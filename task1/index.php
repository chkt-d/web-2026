<?php include 'LeapYear.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Високосный год</title>
</head>
<body>

    <form method="POST">
        <label for="year">Введите год:</label>
        <input type="number" name="year" id="year" required>
        <button type="submit">Проверить</button>
    </form>

    <?php if ($operationResult): ?>
        <h3><?=$operationResult['value']?></h3>
    <?php endif; ?>

</body>
</html>