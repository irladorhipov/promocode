<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Helpers\JwtHelper;

class AuthService
{
    /**
     * Регистрация нового пользователя
     *
     * @param array $data
     * @return User
     * @throws \Exception
     */
    public function signup(array $data): User
    {
        try {
            return User::create($data);
        } catch (\Throwable $e) {
            Log::error(sprintf('User creation failed: %s', $e->getMessage()));
            throw new \Exception('User signup failed. Please try again later.');
        }
    }

    /**
     * @param string $email
     * @param string $password
     * @return string
     * @throws \Exception
     */
    public function login(string $email, string $password): array
    {
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw new \Exception('Invalid credentials', 401);
        }

        return [
           'userData' =>$user,
           'token' => $this->generateJwtToken($user)
        ];
    }

    /**
     * Генерация JWT токена
     *
     * @param User $user
     * @return string
     */
    private function generateJwtToken(User $user): string
    {
        $payload = [
            'iss' => "jwt-auth",
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + config('jwt.token_expiration'),
        ];

        return JwtHelper::encode($payload);
    }
}
