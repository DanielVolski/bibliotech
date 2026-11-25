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
        $cpf = preg_replace('/\D/', '', $value);
        $digits = array_map('intval', str_split($cpf));

        // Cálculo primeiro dígito
        $sum = 0;

        for ($i = 0; $i < 9; $i++) {
            $sum += $digits[$i] * (10 - $i);
        }

        $remainder = ($sum * 10) % 11;
        $firstDigit = $remainder === 10 ? 0 : $remainder;

        // Segundo dígito
        $sum = 0;

        for ($i = 0; $i < 10; $i++) {
            $sum += $digits[$i] * (11 - $i);
        }

        $remainder = ($sum * 10) % 11;
        $secondDigit = $remainder === 10 ? 0 : $remainder;

        if ($digits[9] !== $firstDigit || $digits[10] !== $secondDigit) {
            $fail("Field :attribute must be a valid CPF");
        }
    }
}
