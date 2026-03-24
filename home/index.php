<?php
$posts = [
    [
        'id' => 1,
        'username' => 'Ваня Денисов',
        'avatar' => 'assets/avatar1.png',
        'image' => 'assets/snow_city.png',
        'img_modifier' => '', 
        'likes' => 203,
        'text' => 'Так красиво сегодня на улице! Настоящая зима)) Вспоминается Бродский: «Поздно ночью, в уснувшей долине, на самом дне, в гор...',
        'date' => '1742828400',
        'has_edit' => true
    ],
    [
        'id' => 2,
        'username' => 'Лиза Дёмина',
        'avatar' => 'assets/avatar2.png',
        'image' => 'assets/flowers.png',
        'img_modifier' => '', 
        'likes' => 45,
        'text' => '',
        'date' => '1742817600',
        'has_edit' => false
    ]
];
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лента</title>
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

    <main class="feed">
        <div class="posts__container">
            <?php
            foreach ($posts as $post) {
                include 'post_preview.php';
            }
            ?>
        </div>
    </main>
</body>

</html>