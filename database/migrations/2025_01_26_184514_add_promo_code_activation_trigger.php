<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION check_promo_code_activation()
            RETURNS TRIGGER AS $$
            BEGIN
                -- Проверяем, что промокод еще действителен
                IF (SELECT valid_to FROM promo_codes WHERE id = NEW.promo_code_id) < NOW() THEN
                    RAISE EXCEPTION \'Промокод истек\';
                END IF;

                -- Проверяем, что промокод не превысил лимит активаций
                IF (SELECT max_activations FROM promo_codes WHERE id = NEW.promo_code_id) IS NOT NULL THEN
                    IF (SELECT activation_count FROM promo_codes WHERE id = NEW.promo_code_id) >= (SELECT max_activations FROM promo_codes WHERE id = NEW.promo_code_id) THEN
                        RAISE EXCEPTION \'Лимит активаций промокода исчерпан\';
                    END IF;
                END IF;

                -- Увеличиваем счетчик активаций
                UPDATE promo_codes SET activation_count = activation_count + 1 WHERE id = NEW.promo_code_id;

                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ');

        DB::unprepared('
            CREATE TRIGGER before_promo_code_activation
            BEFORE INSERT ON promo_code_activations
            FOR EACH ROW EXECUTE FUNCTION check_promo_code_activation();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS before_promo_code_activation ON promo_code_activations;');
        DB::unprepared('DROP FUNCTION IF EXISTS check_promo_code_activation();');
    }
};
