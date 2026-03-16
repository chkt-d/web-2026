<?php include "CalcFactorial.php"; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Факториал числа</title>
</head>
<body>

    <form method="POST">
        <label for="num">Введите число:</label>
        <input type="number" name="num" id="num" min="0" required>
        <button type="submit">Вычислить</button>
    </form>

    <?php if ($operationResult): ?>
        <b><?=$operationResult["value"]?></b>
    <?php endif; ?>

</body>
</html>