<?php include 'ZodiacSign.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Знак Зодиака</title>
</head>
<body>

    <form method="POST">
        <label>Введите дату в любом формате:</label><br>
        <input type="text" name="date_input" required>
        <button type="submit">Распознать</button>
    </form>

    <?php if ($operationResult): ?>
        <?php if ($operationResult['isSuccess']): ?>
            <p>Ваша дата в формате день-месяц-год: <?=$operationResult['value']['date']?></p>
            <h3><?=$operationResult['value']['zodiac']?></h3>
        <?php else: ?>
            <h3><?=$operationResult['value']?></h3>
        <?php endif; ?>
    <?php endif; ?>

</body>
</html>