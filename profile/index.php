<?php
$user = [
    'name' => 'Ваня Денисов',
    'avatar' => 'assets/avatar1.png',
    'bio' => 'Привет! Я системный аналитик в ACME :) Тут моя жизнь только для самых классных!',
    'posts_count' => 43
];

$grid_items = [
    ['src' => 'assets/snow_city.png', 'alt' => 'Снежный город'],
    ['src' => 'assets/building.png', 'alt' => 'Здание'],
    ['src' => 'assets/dessert.png', 'alt' => 'Десерт'],
    ['src' => 'assets/friends.png', 'alt' => 'Друзья'],
    ['src' => 'assets/coffee.png', 'alt' => 'Кофе'],
    ['src' => 'assets/book.png', 'alt' => 'Книга'],
];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль <?= $user['name'] ?></title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <header class="sidebar">
        <ul class="sidebar__list">
            <li class="sidebar__item">
                <a href="../home/">
                    <img src="assets/home.png" alt="Главная">
                </a>
            </li>
            <li class="sidebar__item">
                <a href="#">
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

    <main class="content">
        <section class="profile">
            <div class="profile__info">
                <img src="<?= $user['avatar'] ?>" alt="<?= $user['name'] ?>" class="profile__avatar">
                <h1 class="profile__name"><?= $user['name'] ?></h1>
                <p class="profile__bio"><?= $user['bio'] ?></p>
                
                <div class="profile__stats">
                    <img src="assets/grid_icon.png" alt="Иконка сетки" class="profile__stats-icon">
                    <span class="profile__posts-count"><?= $user['posts_count'] ?> поста</span>
                </div>
            </div>

            <div class="grid">
                <?php foreach ($grid_items as $item): ?>
                    <div class="grid__item">
                        <img src="<?= $item['src'] ?>" alt="<?= $item['alt'] ?>" class="grid__image">
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
</body>
</html>