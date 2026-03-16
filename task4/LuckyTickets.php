<?php
require_once __DIR__ . '/../core.php';

function tickets($start, $end)
{
    if (!ctype_digit($start) || !ctype_digit($end)) {
        return createResponse(false, 'Границы должны быть целыми числами');
    }

    $start = (int) $start;
    $end = (int) $end;
    if ($start > $end || $end > 999999) {
        return createResponse(false, 'Неверный диапазон');
    }

    $listOfLuckyTickets = [];
    for ($i = $start; $i <= $end; $i++) {
        $n6 = $i % 10;
        $n5 = (int) ($i / 10) % 10;
        $n4 = (int) ($i / 100) % 10;
        $n3 = (int) ($i / 1000) % 10;
        $n2 = (int) ($i / 10000) % 10;
        $n1 = (int) ($i / 100000) % 10;

        if (($n1 + $n2 + $n3) == ($n4 + $n5 + $n6)) {
            $listOfLuckyTickets[] = $n1 . $n2 . $n3 . $n4 . $n5 . $n6;
        }
    }

    return createResponse(value: $listOfLuckyTickets);
}

$operationResult = null;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['start']) && isset($_POST['end'])) {
    $operationResult = tickets($_POST['start'], $_POST['end']);
    finalizeResponse($operationResult);
}
?>