<?php
$method = $_SERVER['REQUEST_METHOD'];

if ($method !== 'POST') {
    header('Content-Type: application/json');
    http_response_code(405);
    echo json_encode(['error' => 'Запросы разрешены только методом POST']);
    exit;
}

$json_data = file_get_contents('php://input');

$data = json_decode($json_data, true);

if (isset($data['image']) && isset($data['filename'])) {
    
    $image_base64 = $data['image']; 
    $file_name = $data['filename']; 
    
    if (strpos($image_base64, ',') !== false) {
        $image_base64 = explode(',', $image_base64)[1];
    }

    $decoded_image = base64_decode($image_base64);

    $file_path = 'static/' . $file_name;

    if (file_put_contents($file_path, $decoded_image)) {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'message' => 'Файл успешно сохранен',
            'path' => $file_path
        ]);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Не удалось сохранить файл']);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Некорректные данные в JSON']);
}