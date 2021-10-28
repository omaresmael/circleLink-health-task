<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class BloodPressureFormat implements Rule
{

    public function passes($attribute, $value)
    {
        if(!Str::contains($value, '/'))
            return false;
        $readings = explode("/", $value);
        if (sizeof($readings) > 2)
            return false;

        foreach($readings as $reading)
        {
            if(!is_numeric($reading))
                return false;
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
        return 'The blood pressure format ex: 120/80';
    }
}
