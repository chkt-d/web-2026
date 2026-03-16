<?php
require_once __DIR__ . '/../core.php';

function calcFactorial($inNumber) {
    if (!ctype_digit($inNumber)) {
        return createResponse(false, 'Введите целое положитепльно число');
    }

    function factorial($n)
    {
        if ($n <= 1) {
            return 1;
        }
        return $n * factorial($n - 1);
    }

    $num = (int) $inNumber;
    $result = factorial($num);

    if ($result === INF) {
        return createResponse(false, 'Результат слишком велик');
    }
    return createResponse(value: $result);
}

$operationResult = null;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['num'])) {
    $operationResult = calcFactorial($_POST['num']);
    finalizeResponse($operationResult);
}
?>