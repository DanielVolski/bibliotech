<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class CpfValidationRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Retira qualquer caractere que não seja um dígito
        $cpf = preg_replace('/\D/', '', $value);

        // Pega cada caractere de $cpf, converte para inteiro e coloca em um array
        $digits = array_map('intval', str_split($cpf));

        // Primeiro dígito verificador.
        $sum = 0;

        for ($i = 0; $i < 9; $i++) {
            $sum += $digits[$i] * (10 - $i);
        }

        $remainder = ($sum * 10) % 11;
        $firstDigit = $remainder === 10 ? 0 : $remainder;

        if ($digits[9] !== $firstDigit) {
            $fail('O campo :attribute deve ser um CPF válido.');
            return;
        }

        // Segundo dígito verificador.
        $sum = 0;

        for ($i = 0; $i < 10; $i++) {
            $sum += $digits[$i] * (11 - $i);
        }

        $remainder = ($sum * 10) % 11;
        $secondDigit = $remainder === 10 ? 0 : $remainder;

        if ($digits[10] !== $secondDigit) {
            $fail('O campo :attribute deve ser um CPF válido.');
        }
    }
}
