<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class PreventFullCnicModification implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (strlen($value)!=13){
            $fail('CNIC should be 13 digits');
            return;
        }
        $cnic = Auth::user()->cnic;
        $allowed=8;
        $modified=0;
        for ($i = 0; $i < strlen($cnic); $i++) {
            if ($cnic[$i]!=$value[$i]){
                $modified = $modified + 1;
            } 
        }
        if ($modified>$allowed){
            $fail('Only 8 digits are allowed to be chnaged.');
        }
    }
}
