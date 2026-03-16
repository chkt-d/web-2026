<?php
function createResponse($isSuccess = true, $value = null) {
    return [
        'isSuccess' => $isSuccess,
        'value'     => $value,
    ];
}

function finalizeResponse($operationResult) {
    if (!$operationResult || !isset($operationResult['isSuccess'])) {
        http_response_code(500);
        return;
    }
    if ($operationResult['isSuccess']) {
        http_response_code(200);
    } else {
        http_response_code(400);
    }
}