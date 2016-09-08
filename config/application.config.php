<?php
/**
 * Created by PhpStorm.
 * User: rogerio.lamarques
 * Date: 05/09/2016
 * Time: 11:46
 */

namespace Lamarques;

return [
    'db' => [
        'default' => [
            'dbname' => 'framework',
            'user' => 'postgres',
            'password' => 'root',
            'host' => 'localhost',
            'driver' => 'pdo_pgsql',
        ]
    ],
    'entity' => [
        'default' => [
            'Aplicacao\Entity' => __DIR__ . "/../Aplicacao/src/Aplicacao/Entity",
        ]
    ],
    'rotas' => [
        'default' => [
            'module' => 'Aplicacao',
            'controller' => 'index',
            'action' => 'index',
        ]
    ],
    'template' => [
        'template' => '/../Aplicacao/src/Aplicacao/Template/template.phtml',
    ]
];