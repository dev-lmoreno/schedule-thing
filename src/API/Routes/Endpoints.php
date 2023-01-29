<?php

namespace ScheduleThing\API\Routes;

class Endpoints {
    /**
     * schedulething.com/api/{prefix}/{resource}
     * schedulething.com/api/clients/create
     * schedulething.com/api/clients/find
     */
    public function validateExistEndpoint(string $prefix, string $resource): bool
    {
        $endpoints = self::getEndpoints();

        if (empty($endpoints[$prefix])) {
            return false;
        }

        if (empty($endpoints[$prefix][$resource])) {
            return false;
        }

        return true;
    }

    public function getEndpoints(): array
    {
        $endpoints = [
            'clients' => [
                'list' => 'GET',
                'create' => 'POST',
                'update' => 'UPDATE',
                'delete' => 'DELETE'
            ],
            'company' => [
                'list' => 'GET',
                'create' => 'POST',
                'update' => 'UPDATE',
                'delete' => 'DELETE'
            ],
        ];

        return $endpoints;
    }
}
