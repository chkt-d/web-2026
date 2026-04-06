<?php
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
    ORDER BY post.created_at DESC
";

$result = $mysqli->query($sql);

if (!$result) {
    die('Ошибка запроса: ' . $mysqli->error);
}

$posts = [];

while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}
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
        <div class="feed__posts">
            <?php
            foreach ($posts as $post) {
                include 'post_preview.php';
            }
            ?>
        </div>
    </main>
</body>

</html>
