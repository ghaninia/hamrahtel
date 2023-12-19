<?php

namespace Src\Shared\Infrastructure\Laravel\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MobileRule implements ValidationRule
{
    /**
     * Run the validation rule.
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        preg_match('/^09[0-9]{9}$/', $value) ?: $fail('validation.format.mobile')->translate();
    }
}
