<?php

namespace ScheduleThing\Validate;

use ScheduleThing\Constants\Http\StatusCodeConstants;

class CommomValidate {
    public static function formatResponse(
        bool $success = true,
        int $statusCode = StatusCodeConstants::OK,
        string $msg = '',
        mixed $data
    ): array {
        return [
            'success' => $success,
            'statusCode' => $statusCode,
            'msg' => $msg,
            'data' => $data,
        ];
    }

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
        $canBeEmpty = ['id', 'dateCreated', 'dateUpdated'];

        foreach($fields as $key => $field) {
            if (empty($field) && !in_array($key, $canBeEmpty)) {
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

    public static function getPropertyDate($date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
