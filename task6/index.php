<?php include "calcRPN.php"; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Обратная польская запись</title>
</head>
<body>

    <form method="POST">
        <label>Введите выражение:</label><br>
        <input type="text" name="expression" required style="width: 300px;">
        <button type="submit">Вычислить</button>
    </form>

    <?php if ($operationResult): ?>
        <b><?= $operationResult['value'] ?></b>
    <?php endif; ?>

</body>
</html>