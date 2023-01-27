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
}
