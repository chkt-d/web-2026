<?php
$postId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$mysqli = new mysqli('127.0.0.1', 'root', '', 'blog');

if ($mysqli->connect_error) {
    die('Ошибка подключения к БД: ' . $mysqli->connect_error);
}

$mysqli->set_charset('utf8mb4');

$sql = "
    SELECT 
        post.id,
        user.username,
        user.avatar,
        post.image,
        '' AS img_modifier,
        post.likes,
        post.text,
        UNIX_TIMESTAMP(post.created_at) AS date,
        1 AS has_edit
    FROM post
    JOIN user ON post.user_id = user.id
    WHERE post.id = $postId
    LIMIT 1
";

$result = $mysqli->query($sql);

if (!$result) {
    die('Ошибка запроса: ' . $mysqli->error);
}

$postData = $result->fetch_assoc();

function getRelativeTime($ts) {
    $ts = (int) $ts;
    $d = time() - $ts;
    if ($d < 60) return 'только что';
    if ($d < 3600) return floor($d / 60) . ' мин. назад';
    if ($d < 86400) return floor($d / 3600) . ' ч. назад';
    if ($d < 604800) return floor($d / 86400) . ' дн. назад';
    return date('d.m.Y', $ts);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $postData ? 'Пост ' . $postData['username'] : 'Ошибка' ?></title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <header class="sidebar">
        <ul class="sidebar__list">
            <li class="sidebar__item">
                <a href="index.php">
                    <img src="assets/home.png" alt="Главная">
                </a>
            </li>
            <li class="sidebar__item">
                <a href="../profile/">
                    <img src="assets/profile.png" alt="Профиль">
                </a>
            </li>
            <li class="sidebar__item">
                <a href="#">
                    <img src="assets/plus.png" alt="Добавить">
                </a>
            </li>
        </ul>
    </header>

    <main class="post-view">
        <a href="index.php" class="post-view__back">← Назад в ленту</a>

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
                    <img src="<?= $postData['image'] ?>" alt="Пост пользователя <?= $postData['username'] ?>" class="post__image <?= $postData['img_modifier'] ?>">
                </div>

                <footer class="post__footer">
                    <div class="post__likes">
                        <img src="assets/heart.png" alt="Лайк" class="post__like-icon">
                        <span><?= $postData['likes'] ?></span>
                    </div>

                    <?php if ($postData['text'] !== ''): ?>
                        <p class="post__text"><?= $postData['text'] ?></p>
                    <?php endif; ?>

                    <span class="post__date"><?= getRelativeTime($postData['date']) ?></span>
                </footer>
            </article>
        <?php else: ?>
            <div class="post-view__error">
                <h1>Ошибка 404</h1>
                <p>Пост с ID <?= htmlspecialchars($_GET['id'] ?? 'не указан') ?> не найден или указан неверно.</p>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
