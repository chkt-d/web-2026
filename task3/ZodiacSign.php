<?php
require_once __DIR__ . '/../core.php';

function dateProcessing($date): ?array {
    $nums = [];
    $temp = "";

    for ($i = 0; isset($date[$i]); $i++) {
        $char = $date[$i];
        if ($char >= '0' && $char <= '9') {
            $temp .= $char;
        } elseif ($temp !== "") {
            $nums[] = (int)$temp;
            $temp = "";
        }
    }
    if ($temp !== "") $nums[] = (int)$temp;

    if (!isset($nums[0]) || !isset($nums[1])) {
        return null;
    }
    $day = $nums[0];
    $month = $nums[1];
    $year = isset($nums[2]) ? $nums[2] : 2026;

    if ($day > 31 && $year <= 12) {
        $tmp = $year; 
        $year = $day; 
        $day = $month; 
        $month = $tmp;
    }

    if ($month > 12 && $day <= 12) {
        $tmp = $day; 
        $day = $month; 
        $month = $tmp;
    } elseif ($month > 12 && $year <= 12) {
        $tmp = $year; 
        $year = $month; 
        $month = $tmp;
    } elseif ($month < 1 || $month > 12) {
        return null;
    }

    $daysInMonth = [
        1 => 31, 2 => 28, 3 => 31, 4 => 30, 5 => 31, 6 => 30,
        7 => 31, 8 => 31, 9 => 30, 10 => 31, 11 => 30, 12 => 31
    ];
    if (($year % 400 == 0) || ($year % 4 == 0 && $year % 100 != 0)) {
        $daysInMonth[2] = 29;
    }
    if ($day < 1 || $day > $daysInMonth[$month]) {
        if ($year <= $daysInMonth[$month]){
            $tmp = $year; $year = $day; $day = $tmp;
        } else {
            return null;
        }
    }

    return [$day, $month, $year];
}

function determineTheZodiac($dateStr) {
    $nums = dateProcessing($dateStr);
    if (!$nums) {
        return createResponse(false, 'Введена некорректная дата');
    }

    [$day, $month, $year] = $nums;
    $zodiac = "";
    if (($month == 3 && $day >= 21) || ($month == 4 && $day <= 19)) $zodiac = "Овен";
    elseif (($month == 4 && $day >= 20) || ($month == 5 && $day <= 20)) $zodiac = "Телец";
    elseif (($month == 5 && $day >= 21) || ($month == 6 && $day <= 20)) $zodiac = "Близнецы";
    elseif (($month == 6 && $day >= 21) || ($month == 7 && $day <= 22)) $zodiac = "Рак";
    elseif (($month == 7 && $day >= 23) || ($month == 8 && $day <= 22)) $zodiac = "Лев";
    elseif (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) $zodiac = "Дева";
    elseif (($month == 9 && $day >= 23) || ($month == 10 && $day <= 22)) $zodiac = "Весы";
    elseif (($month == 10 && $day >= 23) || ($month == 11 && $day <= 21)) $zodiac = "Скорпион";
    elseif (($month == 11 && $day >= 22) || ($month == 12 && $day <= 21)) $zodiac = "Стрелец";
    elseif (($month == 12 && $day >= 22) || ($month == 1 && $day <= 19)) $zodiac = "Козерог";
    elseif (($month == 1 && $day >= 20) || ($month == 2 && $day <= 18)) $zodiac = "Водолей";
    elseif (($month == 2 && $day >= 19) || ($month == 3 && $day <= 20)) $zodiac = "Рыбы";

    return createResponse(value: ['date' => $day . '.' . $month . '.' . $year, 'zodiac' => $zodiac]);
}

$operationResult = null;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['date_input'])) {
    $operationResult = determineTheZodiac($_POST['date_input']);
    finalizeResponse($operationResult);
}
?>
