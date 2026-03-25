<?php
require_once __DIR__ . '/../core.php';

function evaluateRpn($expressionInRPN)
{
    $stack = [];
    $top = -1;
    $temp = "";

    $expressionInRPN = trim($expressionInRPN);
    if ($expressionInRPN === "") {
        return createResponse(false, "Выражение пустое");
    }

    for ($i = 0; isset($expressionInRPN[$i]); $i++) {
        $char = $expressionInRPN[$i];
        $nextChar = isset($expressionInRPN[$i+1]) ? $expressionInRPN[$i+1] : null;

        if (($char >= '0' && $char <= '9') || ($char === '-' && $temp === "" && $nextChar >= '0' && $nextChar <= '9')) {
            $temp .= $char;
        } elseif ($char == ' ' && $temp !== "") {
            $top++;
            $stack[$top] = (int) $temp;
            $temp = "";
        } elseif ($char == '+' || $char == '-' || $char == '*') {
            if ($temp !== "") {
                $top++;
                $stack[$top] = (int) $temp;
                $temp = "";
            }

            if ($top < 1 && $char !== '-') {
                return createResponse(false, "Недостаточно чисел");
            } 
            
            if ($top < 1 && $char === '-') {
                $res = 0 - $stack[$top];
            } else { 
                if ($top > 1) {
                    return createResponse(false, "Недостаточно чисел");
                }
                $secondOperand = $stack[$top];
                $top--;
                $firstOperand = $stack[$top];
                if ($char == '+')
                    $res = $secondOperand + $firstOperand;
                elseif ($char == '-')
                    $res = $firstOperand - $secondOperand;
                elseif ($char == '*')
                    $res = $secondOperand * $firstOperand;
            }
            $stack[$top] = $res;
 
        } elseif ($char !== ' ') {
            return createResponse(false, 'Встречен недопустимый символ: "' . $char . '"');
        }
    }
    if ($temp !== "") {
        $top++;
        $stack[$top] = (int)$temp;
        $temp = "";
    }
    if ($top !== 0) {
        return createResponse(false, "Неверный формат, осталось лишних операндов: " . ($top + 1));
    }

    return createResponse(value: $stack[0]);
}

$operationResult = null;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['expression'])) {
    $operationResult = evaluateRpn($_POST['expression']);
    finalizeResponse($operationResult);
}
?>