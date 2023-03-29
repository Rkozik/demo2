<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmployeeIDValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $valueParts = explode("-", $value);

        if(
            empty(count($valueParts)) ||
            !ctype_alpha($valueParts[0]) ||
            !ctype_digit($valueParts[1]) ||
            strlen($valueParts[1]) > 17 || // full length of ID is max of 20 i.e. xy- == 3 so 17 is max len
            strlen($valueParts[1]) < 1
        ){
            $fail('The employee ID format is invalid.');
        }
    }
}
