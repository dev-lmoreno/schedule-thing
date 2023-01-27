<?php

namespace ScheduleThing\Validate\Client;

class ClientValidate {
    private static function calculateValidCpf(string $cpf): bool
    {
        $firstVerifiedDigit = $secondVerifiedDigit = 0;

        $firstNineDigits = substr($cpf, 0, 9);

        $countFirst = 0;
        $multiplierFirst = 10;
        for ($i = 0; $i < 9; $i++) {
            $countFirst += $firstNineDigits[$i] * $multiplierFirst--;
        }

        $remainder = $countFirst % 11;

        if ($remainder >= 2) {
            $firstVerifiedDigit = 11 - $remainder;
        }

        $cpfWithFirstDigit = $firstNineDigits . $firstVerifiedDigit;

        $countSecond = 0;
        $multiplierSecond = 11;
        for ($i = 0; $i < 10; $i++) {
            $countSecond += $cpfWithFirstDigit[$i] * $multiplierSecond--;
        }

        $remainder = $countSecond % 11;

        if ($remainder >= 2) {
            $secondVerifiedDigit = 11 - $remainder;
        }

        $cpfValid = $cpfWithFirstDigit . $secondVerifiedDigit;

        if ((string) $cpfValid === $cpf) {
            return true;
        }

        return false;
    }

    public static function isValidCpf(string $cpf): bool
    {
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        if (!self::calculateValidCpf($cpf)) {
            return false;
        }

        return true;
    }
}
