<?php

namespace ScheduleThing\Validate\Company;

class CompanyValidate {
    private static function calculateValidCpf(string $cnpj): bool
    {
        $cnpj = strrev($cnpj);

        $firstVerifiedDigit = $secondVerifiedDigit = 0;

        $firstTwelveDigits = substr($cnpj, 2, 12);

        $countFirst = 0;
        $multiplierFirst = 9;
        $auxMultiplierFirst = 9;
        for ($i = 0; $i < 12; $i++) {
            if ($i < 8 && $multiplierFirst >= 2) {
                $countFirst += $firstTwelveDigits[$i] * $multiplierFirst--;
            } else {
                $countFirst += $firstTwelveDigits[$i] * $auxMultiplierFirst--;
            }

        }

        $remainder = $countFirst % 11;
        $firstVerifiedDigit = $remainder;

        $cnpjWithFirstDigit = $firstVerifiedDigit . $firstTwelveDigits;

        $countSecond = 0;
        $multiplierSecond = 9;
        $auxMultiplierSecond = 9;
        for ($i = 0; $i < 13; $i++) {
            if ($i < 8 && $multiplierSecond >= 2) {
                $countSecond += $cnpjWithFirstDigit[$i] * $multiplierSecond--;
            } else {
                $countSecond += $cnpjWithFirstDigit[$i] * $auxMultiplierSecond--;
            }
        }

        $remainder = $countSecond % 11;
        $secondVerifiedDigit = $remainder;

        $cnpjValid = strrev($secondVerifiedDigit . $cnpjWithFirstDigit);

        if ((string) $cnpjValid === strrev($cnpj)) {
            return true;
        }

        return false;
    }

    public static function isValidCnpj(string $cnpj): bool
    {
        $cnpj = preg_replace( '/[^0-9]/is', '', $cnpj );

        if (strlen($cnpj) != 14) {
            return false;
        }

        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }

        if (!self::calculateValidCpf($cnpj)) {
            return false;
        }

        return true;
    }
}
