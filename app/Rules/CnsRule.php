<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CnsRule implements Rule
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
        if (strlen($value) !== 15) {
            return false;
        }

        $soma = 0;
        $resto = 0;
        $dv = 0;
        $pis = '';
        $resultado = '';

        if (substr($value, 0, 1) === '1' || substr($value, 0, 1) === '2') {
            $pis = substr($value, 0, 11);

            $soma = (intval(substr($pis, 0, 1)) * 15) +
                (intval(substr($pis, 1, 1)) * 14) +
                (intval(substr($pis, 2, 1)) * 13) +
                (intval(substr($pis, 3, 1)) * 12) +
                (intval(substr($pis, 4, 1)) * 11) +
                (intval(substr($pis, 5, 1)) * 10) +
                (intval(substr($pis, 6, 1)) * 9) +
                (intval(substr($pis, 7, 1)) * 8) +
                (intval(substr($pis, 8, 1)) * 7) +
                (intval(substr($pis, 9, 1)) * 6) +
                (intval(substr($pis, 10, 1)) * 5);

            $resto = $soma % 11;
            $dv = 11 - $resto;

            if ($dv == 11) {
                $dv = 0;
            }

            if ($dv == 10) {
                $soma = (intval(substr($pis, 0, 1)) * 15) +
                    (intval(substr($pis, 1, 1)) * 14) +
                    (intval(substr($pis, 2, 1)) * 13) +
                    (intval(substr($pis, 3, 1)) * 12) +
                    (intval(substr($pis, 4, 1)) * 11) +
                    (intval(substr($pis, 5, 1)) * 10) +
                    (intval(substr($pis, 6, 1)) * 9) +
                    (intval(substr($pis, 7, 1)) * 8) +
                    (intval(substr($pis, 8, 1)) * 7) +
                    (intval(substr($pis, 9, 1)) * 6) +
                    (intval(substr($pis, 10, 1)) * 5) + 2;

                $resto = $soma % 11;
                $dv = 11 - $resto;
                $resultado = $pis . '001' . intval($dv);
            } else {
                $resultado = $pis . '000' . intval($dv);
            }

            if ($value != $resultado) {
                return false;
            } else {
                return true;
            }
        } else {
            if (trim($value) == '' || strlen($value) != 15) {
                return false;
            }

            $soma = (intval(substr($value, 0, 1)) * 15) +
                (intval(substr($value, 1, 1)) * 14) +
                (intval(substr($value, 2, 1)) * 13) +
                (intval(substr($value, 3, 1)) * 12) +
                (intval(substr($value, 4, 1)) * 11) +
                (intval(substr($value, 5, 1)) * 10) +
                (intval(substr($value, 6, 1)) * 9) +
                (intval(substr($value, 7, 1)) * 8) +
                (intval(substr($value, 8, 1)) * 7) +
                (intval(substr($value, 9, 1)) * 6) +
                (intval(substr($value, 10, 1)) * 5) +
                (intval(substr($value, 11, 1)) * 4) +
                (intval(substr($value, 12, 1)) * 3) +
                (intval(substr($value, 13, 1)) * 2) +
                (intval(substr($value, 14, 1)) * 1);

            $resto = $soma % 11;

            if ($resto != 0) {
                return false;
            }

            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Entre com um valor válido para o cns.';
    }
}
