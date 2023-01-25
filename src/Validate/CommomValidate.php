<?php

namespace ScheduleThing\Validate;

use stdClass;

class CommomValidate {
    /**
     * Método retorna um array indicando os campos vazios
     * to-do: adicionar array|bool ao tipo do $field após subir a versão do php para 8
     */
    public static function isEmptyFields($fields): array
    {
        // TESTAR ESSA CONDIÇÃO
        if (!is_array($fields) && !is_object($fields)) {
            return false;
        }

        if (is_object($fields)) {
            $fields = json_decode(json_encode($fields), true);
        }

        $validatedFields = [];

        foreach($fields as $field) {
            // to-do: melhorar a condição
            if (empty($field)) {
                $validatedFields[$field] = true;
            }
        }

        return $validatedFields;
    }

    // to-do: adicionar string|int|bool ao tipo do $field após subir a versão do php para 8
    public static function isEmptyField($field): bool
    {
        if (empty($field)) {
            return true;
        }

        return false;
    }
}