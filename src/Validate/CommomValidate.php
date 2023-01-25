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

    public static function isEmptyFields(object|array|bool $fields): array
    {
        if (!is_array($fields) && !is_object($fields)) {
            return false;
        }

        if (is_object($fields)) {
            $fields = self::convertObjectToArray($fields);
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
}
