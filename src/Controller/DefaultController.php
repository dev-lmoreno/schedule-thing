<?php

namespace ScheduleThing\Controller;

use Exception;
use ScheduleThing\Controller\Client\ClientController;
use ScheduleThing\Controller\Company\CompanyController;

class DefaultController {
    const BASE_CONTROLLER_NAMESPACE = 'ScheduleThing\Controller';
    /**
     * Realiza a instanciação dinâmica da classe de acordo com o prefix recebido
     */
    public function redirect(string $prefix): object
    {
        $prefixToController = [
            'clients' => ClientController::class,
            'companies' => CompanyController::class,
        ];

        $controller = $prefixToController[$prefix];

        if (class_exists($controller)) {
            $controllerInstance = new $controller();
            return $controllerInstance;
        }

        throw new Exception("Class not found");
    }
}
