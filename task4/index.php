<?php include 'LuckyTickets.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Счастливые билеты</title>
</head>
<body>

    <form method="POST">
        <label>Старт:</label>
        <input type="text" name="start" required>
        <br><br>
        <label>Конец:</label>
        <input type="text" name="end" required>
        <br><br>
        <button type="submit">Найти билеты</button>
        <br><br>
    </form>

    <?php if ($operationResult): ?>
        <?php if ($operationResult['isSuccess']): ?>
            <div class="ticket-list">
                <?php foreach ($operationResult['value'] as $ticket): ?>
                    <span class="ticket"><?= $ticket ?></span>
                <?php endforeach; ?>
            </div>   
        <?php else: ?>
            <p class="error"><?= $operationResult['value'] ?></p>
        <?php endif; ?>
    <?php endif; ?>

</body>
</html>