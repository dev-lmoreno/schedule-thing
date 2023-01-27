<?php

namespace ScheduleThing\Validate;

class CommomValidate {
    public static function convertObjectToArray(object $value): array
    {
        if (is_object($value)) {
            return json_decode(json_encode($value), true);
        }

        return [];
    }

    public static function isEmptyFields(array|bool $fields): array
    {
        if (!is_array($fields)) {
            return false;
        }

        $validatedFields = [];

        foreach($fields as $key => $field) {
            if (empty($field)) {
                $validatedFields[$key] = true;
            }
        }

        return $validatedFields;
    }

    public static function isEmptyField(string|int|bool $field): bool
    {
        if (empty($field)) {
            return true;
        }

        return false;
    }

    public static function isValidEmail(string $email): bool
    {
        $emailSanitize = filter_var($email, FILTER_SANITIZE_EMAIL);
        $isValidEmail = filter_var($emailSanitize, FILTER_VALIDATE_EMAIL);

        if ($isValidEmail) {
            return true;
        }

        return false;
    }

    /**
     * to-do: entender a lógica da validação de cnpj
     */
    public static function isValidCnpj(string $cnpj): bool
    {
        $cnpj = preg_replace( '/[^0-9]/is', '', $cnpj );

        if (strlen($cnpj) != 14)
            return false;

        // Verifica se todos os digitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj))
            return false;

        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $count = 0; $i < 12; $i++) {
            $count += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $remainder = $count % 11;

        if ($cnpj[12] != ($remainder < 2 ? 0 : 11 - $remainder)) {
            return false;
        }

        for ($i = 0, $j = 6, $count = 0; $i < 13; $i++) {
            $count += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $remainder = $count % 11;

        $isValidCnpj = $cnpj[13] == ($remainder < 2 ? 0 : 11 - $remainder);

        if ($isValidCnpj) {
            return true;
        }

        return false;
    }
}
