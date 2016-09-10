<?php
/**
 * Created by PhpStorm.
 * User: rogerio.lamarques
 * Date: 05/09/2016
 * Time: 15:30
 */

namespace Lamarques;


use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Controller
{
    public $db;
    public $config;
    public $view;
    public $em;
    public $sessao;
    public $menu;

    private $uri;

    public function __construct(array $config, $client = 'default', Uri $uri)
    {
        $this->setConfig($config);
        $this->view = new View($config['current_state']);
        $dbconfig = (isset($config['db'][$client])) ? $config['db'][$client] : $config['db']['default'];
        $entityPath = (isset($config['entity'][$client])) ? $config['entity'][$client] : $config['entity']['default'];
        $this->connectDb($dbconfig, $entityPath);
        $sessao =  new Session($client);
        $this->sessao = $sessao;
        $this->uri = $uri;
        if($this->getSessao()->getSession()) {
            $menu = new Menu($this->getSessao()->getSession()['permissoes']);
            $this->menu = $menu->getMenu();
            $this->view->setGlobalData('menu', $this->menu);
            $this->view->setGlobalData('sessao', $this->getSessao()->getSession());
        }
    }

    /**
     * @return Session
     */
    public function getSessao()
    {
        return $this->sessao;
    }



    /**
     * @return mixed
     */
    public function getParams($param)
    {
        return $this->uri->getUri($param);
    }

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param mixed $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    public function view($data){
        return $this->view->view($data);
    }

    /**
     * @return EntityManager
     */
    public function getEm()
    {
        return $this->em;
    }

    /**
     * @param EntityManager $em
     */
    public function setEm(EntityManager $em)
    {
        $this->em = $em;
    }

    private function connectDb(array $dbConfig, $entityPath)
    {
        $classLoader = new \Doctrine\Common\ClassLoader();
        $classLoader->register();

        $driver = new AnnotationDriver(new AnnotationReader(), $entityPath);
        AnnotationRegistry::registerLoader('class_exists');

        $config = Setup::createAnnotationMetadataConfiguration($entityPath);
        $config->setMetadataDriverImpl($driver);
        $entityManager = EntityManager::create($dbConfig, $config);
        $this->setEm($entityManager);
    }

}