<?php

return [
    'secret_key' => env('JWT_SECRET'),
    'token_expiration' => env('JWT_TOKEN_EXPIRATION', 3600),
];
