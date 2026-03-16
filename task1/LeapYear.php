<?php
require_once __DIR__ . '/../core.php';
function isYearLeap($yearStr) {
    if (!is_numeric($yearStr) || $yearStr < 0 || $yearStr > 30000) {
        return createResponse(false, 'Некорректный год');
    }
    
    $year = (int)$yearStr;
    $isLeap = ($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0);
    
    return createResponse(value: $isLeap ? "YES" : "NO");
}

$operationResult = null;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['year'])) {
    $operationResult = isYearLeap($_POST['year']);
    finalizeResponse($operationResult);
}
?>