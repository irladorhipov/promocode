<?php


namespace App\Services;

use App\Models\User;
use App\Models\PromoCode;
use App\Models\PromoCodeActivation;
use Illuminate\Support\Facades\DB;
use Exception;

class PromoCodeService
{
    /**
     * Активирует промокод для пользователя.
     *
     * @param int $userId
     * @param string $code
     * @return array
     * @throws Exception
     */
    public function activate(int $userId, string $code): array
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($userId);
            $promoCode = PromoCode::where('code', $code)->firstOrFail();

            if ($user->promoCodeActivations()->where('promo_code_id', $promoCode->id)->exists()) {
                throw new Exception('Промокод уже был активирован');
            }

            if ($promoCode->valid_to && $promoCode->valid_to < now()) {
                throw new Exception('Срок действия промокода истек');
            }

            if ($promoCode->max_activations && $promoCode->activation_count >= $promoCode->max_activations) {
                throw new Exception('Лимит активаций промокода исчерпан');
            }

            $activation = new PromoCodeActivation([
                'user_id' => $user->id,
                'promo_code_id' => $promoCode->id,
                'activated_at' => now(),
            ]);
            $activation->save();

            $user->balance += $promoCode->amount;
            $user->save();

            $promoCode->increment('activation_count');

            DB::commit();

            return [
                'message' => 'Промокод успешно активирован',
                'balance' => $user->balance,
            ];

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
