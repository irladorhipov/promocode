<?php

namespace App\Helpers;

use Exception;

class JwtHelper
{
    private static $algorithm = 'HS256';

    /**
     * Генерация JWT
     *
     * @param array $payload Данные для токена
     * @return string JWT
     */
    public static function encode(array $payload): string
    {
        $header = [
            'alg' => self::$algorithm,
            'typ' => 'JWT',
        ];

        $headerBase64 = self::base64UrlEncode(json_encode($header));
        $payloadBase64 = self::base64UrlEncode(json_encode($payload));

        $signature = self::sign("$headerBase64.$payloadBase64");

        return "$headerBase64.$payloadBase64.$signature";
    }

    /**
     * Декодирование JWT
     *
     * @param string $token JWT
     * @return array|null Данные из токена
     */
    public static function decode(string $token): ?array
    {
        $parts = explode('.', $token);
        if (count($parts) !== 3) {
            throw new Exception('Некорректный формат токена');
        }

        list($headerBase64, $payloadBase64, $signature) = $parts;

        if (!self::verify("$headerBase64.$payloadBase64", $signature)) {
            throw new Exception('Неверная подпись токена');
        }

        return json_decode(self::base64UrlDecode($payloadBase64), true);
    }

    /**
     * Создание подписи
     *
     * @param string $data Данные для подписи
     * @return string Подпись
     */
    private static function sign(string $data): string
    {
        return self::base64UrlEncode(hash_hmac('sha256', $data, config('jwt.token_expiration'), true));
    }

    /**
     * Проверка подписи
     *
     * @param string $data Данные
     * @param string $signature Подпись
     * @return bool Результат проверки
     */
    private static function verify(string $data, string $signature): bool
    {
        $expectedSignature = self::sign($data);
        return hash_equals($expectedSignature, $signature);
    }

    /**
     * Кодирование в Base64Url
     *
     * @param string $data Данные
     * @return string Закодированная строка
     */
    private static function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * Декодирование из Base64Url
     *
     * @param string $data Закодированная строка
     * @return string Декодированные данные
     */
    private static function base64UrlDecode(string $data): string
    {
        return base64_decode(strtr($data, '-_', '+/'));
    }
}
