<?php
$postId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$posts = [
    1 => [
        'id' => 1,
        'username' => 'Ваня Денисов',
        'avatar' => 'assets/avatar1.png',
        'image' => 'assets/snow_city.png',
        'img_modifier' => '', 
        'likes' => 203,
        'text' => 'Так красиво сегодня на улице! Настоящая зима)) Вспоминается Бродский: «Поздно ночью, в уснувшей долине, на самом дне, в гор...',
        'date' => 1774224000,
        'has_edit' => true
    ],
    2 => [
        'id' => 2,
        'username' => 'Лиза Дёмина',
        'avatar' => 'assets/avatar2.png',
        'image' => 'assets/flowers.png',
        'img_modifier' => '', 
        'likes' => 45,
        'text' => '',
        'date' => time() - 7200,
        'has_edit' => false
    ]
];

$postData = $posts[$postId] ?? null;

function getRelativeTime($ts) {
    $ts = (int)$ts;
    $d = time() - $ts;
    if ($d < 60) return "только что";
    if ($d < 3600) return floor($d / 60) . " мин. назад";
    if ($d < 86400) return floor($d / 3600) . " ч. назад";
    if ($d < 604800) return floor($d / 86400) . " дн. назад";
    return date('d.m.Y', $ts);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $postData ? "Пост " . $postData['username'] : "Ошибка" ?></title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <main class="post-view">
        <a href="index.php" class="back-link">← Назад в ленту</a>

        <?php if ($postData): ?>
            <article class="post">
                <header class="post__header">
                    <div class="post__user">
                        <img src="<?= $postData['avatar'] ?>" alt="<?= $postData['username'] ?>" class="post__avatar">
                        <span class="post__username"><?= $postData['username'] ?></span>
                    </div>
                    <?php if ($postData['has_edit']): ?>
                        <img src="assets/edit.png" alt="Редактировать" class="post__edit-icon">
                    <?php endif; ?>
                </header>

                <div class="post__content">
                    <img src="<?= $postData['image'] ?>" alt="Контент" class="post__image <?= $postData['img_modifier'] ?>">
                </div>

                <footer class="post__footer">
                    <div class="post__likes">
                        <img src="assets/heart.png" alt="Лайк">
                        <span><?= $postData['likes'] ?></span>
                    </div>
                    <p class="post__text"><?= $postData['text'] ?></p>
                    <p class="post__date"><?= getRelativeTime($postData['date']) ?></p>
                </footer>
            </article>
        <?php else: ?>
            <div class="error-message">
                <h1>Ошибка 404</h1>
                <p>Пост с ID <?= htmlspecialchars($_GET['id'] ?? 'не указан') ?> не найден или указан неверно.</p>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>