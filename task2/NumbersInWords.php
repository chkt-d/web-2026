<?php
require_once __DIR__ . '/../core.php';
function digitToWord($digit) {
    if (!is_numeric($digit) || $digit < 0 || $digit > 9) {
        return createResponse(false, 'Введена не цифра');
    }

    $words = ["Ноль", "Один", "Два", "Три", "Четыре", "Пять", "Шесть", "Семь", "Восемь", "Девять"];

    return createResponse(value: $words[$digit]);
}

$operationResult = null;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['digit'])) {
    $operationResult = digitToWord($_POST['digit']);
    finalizeResponse($operationResult);
}
?>