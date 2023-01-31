<?php

namespace ScheduleThing\API\Routes;

class Endpoints {
    /**
     * schedulething.com/api/{prefix}/{resource}
     * schedulething.com/api/clients
     * schedulething.com/api/clients/1
     * schedulething.com/api/clients/create
     * schedulething.com/api/clients/update/1
     * schedulething.com/api/clients/delete/1
     */
    public function validateExistEndpoint(string $prefix, string $resource = ''): bool
    {
        $endpoints = self::getEndpoints();

        if (empty($endpoints[$prefix])) {
            return false;
        }

        if (empty($endpoints[$prefix][$resource])) {
            if (preg_match('/^\d+$/', $resource) || $resource === '') {
                return true;
            }

            return false;
        }

        return true;
    }

    public function getEndpoints(): array
    {
        $endpoints = [
            'clients' => [
                ''.
                'create',
                'update',
                'delete',
            ],
        ];

        return $endpoints;
    }
}
