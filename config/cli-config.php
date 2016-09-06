<?php
/**
 * Created by PhpStorm.
 * User: rogerio.lamarques
 * Date: 06/09/2016
 * Time: 14:48
 */
require_once __DIR__ . '/../vendor/autoload.php';

$isDevMode = true;
$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration([__DIR__ . "/../Aplicacao/src/Aplicacao/Entity"], $isDevMode);
$conn = array(
    'dbname' => 'framework',
    'user' => 'postgres',
    'password' => 'root',
    'host' => 'localhost',
    'driver' => 'pdo_pgsql',
);

$entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);

