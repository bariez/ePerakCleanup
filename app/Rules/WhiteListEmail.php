<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class WhiteListEmail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $allowedDomains = config('email.white-list-domains');
        $emailDomain = substr(strrchr($value, "@"), 1);

        // Check if the domain is in the allowed domains
        if (in_array($emailDomain, $allowedDomains)) {
            return true;
        }

        // Check if the domain ends with gov.my
        if (preg_match('/\.gov\.my$/', $emailDomain)) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The email address must be from a valid domain (gmail.com, yahoo.com, or gov.my).';
    }
}
