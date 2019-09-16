<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Cache;

class ReCaptcha implements Rule
{
    protected $key;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($key)
    {
        $this->key = $key;
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
        if(Cache::get($this->key) > config('custom.reCaptcha.maxAttempts')) {
            (request('g-recaptcha-response') ? true : false);
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Error in ReCaptcha.';
    }
}
