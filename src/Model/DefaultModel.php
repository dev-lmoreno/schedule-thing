<?php

namespace ScheduleThing\Model;

use Exception;
use ScheduleThing\Model\Client\ClientModel;

class DefaultModel {
    const BASE_MODEL_NAMESPACE = 'ScheduleThing\Model';

    /**
     * Remove classvar from the model that should not be sent by the request
     */
    private function addGhostValueToClassVar(array $classVars): array
    {
        $classVars['id'] = null;
        $classVars['dateCreated'] = null;
        $classVars['dateUpdated'] = null;

        return $classVars;
    }

    public function convertRequestDataToModel(array $request_data, string $prefix): object
    {
        $prefixToModel = [
            'clients' => ClientModel::class,
        ];

        $model = $prefixToModel[$prefix];

        if (class_exists($model)) {
            $classVars = get_class_vars($model);
            $vars = self::addGhostValueToClassVar($request_data);

            foreach ($classVars as $key => $classVar) {
                $classVars[$key] = $vars[$key];
            }

            $modelInstance = new $model(
                ...array_values($classVars)
            );

            return $modelInstance;
        }

        throw new Exception("Class not found");
    }
}
