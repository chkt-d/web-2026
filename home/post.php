<?php
$postId = $_GET['id'] ?? 'Не указан'; 

$postData = [
    'id' => 1,
    'username' => 'Ваня Денисов',
    'avatar' => 'assets/avatar1.png',
    'image' => 'assets/snow_city.png',
    'img_modifier' => '', 
    'likes' => 203,
    'text' => 'Так красиво сегодня на улице! Настоящая зима)) Вспоминается Бродский: «Поздно ночью, в уснувшей долине, на самом дне, в городке, занесенном снегом по ручку двери...» ',
    'date' => '1742828400',
    'has_edit' => true
];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Пост №<?= $postId ?></title> 
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <main class="post-view">
        <a href="index.php" class="back-link">← Назад в ленту</a>
        
        <article class="post">
            <header class="post__header">
                <div class="post__user">
                    <img src="<?= $postData['avatar'] ?>" alt="<?= $postData['username'] ?>" class="post__avatar">
                    <span class="post__username"><?= $postData['username'] ?> (ID: <?= $postId ?>)</span>
                </div>
                <?php if ($postData['has_edit']): ?>
                    <img src="assets/edit.png" alt="Редактировать" class="post__edit-icon">
                <?php endif; ?>
            </header>

            <div class="post__content">
                <img src="<?= $postData['image'] ?>" 
                     alt="Контент" 
                     class="post__image <?= $postData['img_modifier'] ?>">
            </div>

            <footer class="post__footer">
                <div class="post__likes">
                    <img src="assets/heart.png" alt="Лайк">
                    <span><?= $postData['likes'] ?></span>
                </div>
                <p class="post__text"><?= $postData['text'] ?></p>
                <p class="post__date"><?= date('d.m.Y H:i', $postData['date']) ?></p>
            </footer>
        </article>
    </main>
</body>
</html>