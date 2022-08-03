<?php

function is_production(): bool {
    return config('app.env') === 'production';
}

function json_error($code = 500, $errors = []) {
    switch ($code) {
        case 400:
            $message = 'Bad Request.';
            break;
        case 401:
            $message = 'Unauthorized';
            break;
        case 404:
            $message = 'Resource not found.';
            break;
        case 422:
            $message = 'The given data was invalid.';
            break;
        case 500:
            $message = 'Server Error.';
            break;
        case 503:
            $message = 'Service Unavailable.';
            break;
        default:
            $message = 'Unregistered error.';
    }

    $response = count($errors) ? compact('message', 'errors') : compact('message');
    return response()->json($response, $code);
}
