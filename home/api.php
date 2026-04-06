<?php

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

if ($method !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Запросы разрешены только методом POST']);
    exit;
}

$jsonData = $_POST['data'] ?? file_get_contents('php://input');
$data = json_decode($jsonData, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'Некорректный JSON']);
    exit;
}

$user_id = $data['user_id'] ?? null;
$text = $data['text'] ?? '';

if (!$user_id) {
    http_response_code(400);
    echo json_encode(['error' => 'user_id обязателен']);
    exit;
}

if (!isset($_FILES['image'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Файл image обязателен']);
    exit;
}

$image = $_FILES['image'];

if ($image['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['error' => 'Ошибка загрузки файла']);
    exit;
}

$imagesDir = 'images';

if (!is_dir($imagesDir)) {
    mkdir($imagesDir, 0777, true);
}

$fileName = time() . '_' . basename($image['name']);
$filePath = $imagesDir . '/' . $fileName;

if (!move_uploaded_file($image['tmp_name'], $filePath)) {
    http_response_code(500);
    echo json_encode(['error' => 'Не удалось сохранить файл']);
    exit;
}

$mysqli = new mysqli('127.0.0.1', 'root', '', 'blog');

if ($mysqli->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Ошибка подключения к БД']);
    exit;
}

$mysqli->set_charset('utf8mb4');

$likes = 0;

$stmt = $mysqli->prepare("
    INSERT INTO post (user_id, image, text, likes)
    VALUES (?, ?, ?, ?)
");

if (!$stmt) {
    http_response_code(500);
    echo json_encode(['error' => 'Ошибка подготовки запроса']);
    exit;
}

$stmt->bind_param('issi', $user_id, $filePath, $text, $likes);

if (!$stmt->execute()) {
    http_response_code(500);
    echo json_encode(['error' => 'Ошибка выполнения запроса']);
    exit;
}

echo json_encode([
    'status' => 'success',
    'message' => 'Пост успешно создан',
    'post_id' => $stmt->insert_id,
    'image' => $filePath
]);

$stmt->close();
$mysqli->close();
exit;