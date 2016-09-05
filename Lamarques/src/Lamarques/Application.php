<?php
/**
 * Created by PhpStorm.
 * User: rogerio.lamarques
 * Date: 05/09/2016
 * Time: 11:43
 */

namespace Lamarques;

class Application
{

    private $dbConfig = [];
    private $defaultRoute;
    private $config;
    /**
     * @var Uri $uri
     */
    public $uri;

    /**
     * Application constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->setUri(new Uri());
        $this->setConfig($config);
        if(isset($config['db'])) {
            $this->setDbConfig($config['db']);
        }
        if(isset($config['rotas']['default'])) {
            $this->setDefaultRoute($config['rotas']['default']);
        }
    }

    /**
     * @throws \Exception
     */
    public function start()
    {
        $module = $this->getUri('module');
        $controller = $this->getUri('controller');
        $action = $this->getUri('action');

        if(!$module){
            $module = $this->getDefaultRoute('module');
        }
        if(!$controller){
            $controller = $this->getDefaultRoute('controller');
        }
        if(!$action){
            $action =  $this->getDefaultRoute('action');
        }

        if(!$module || !$controller || !$action) {
            throw new \Exception(
                'Modulo ou Controle ou Action nao está setado' . '<br>' .
                'Modulo: ' . $module . '<br>' .
                'Controle: ' . $controller . '<br>' .
                'Acao: ' . $action . '<br>'
            );
        }
        $this->config['current_state'] = [
            'module' => $module,
            'controller' => $controller,
            'action' => $action
        ];
        $class = "\\" . ucfirst($module) . "\\Controller\\" . ucfirst($controller) . "Controller";
        $instancia = new $class($this->getConfig());
        $object = $action . 'Action';
        $instancia->$object();

    }

    /**
     * @return array
     */
    public function getDbConfig()
    {
        return $this->dbConfig;
    }

    /**
     * @param array $dbConfig
     */
    public function setDbConfig(array $dbConfig)
    {
        $this->dbConfig = $dbConfig;
    }

    /**
     * @return Uri
     */
    public function getUri($i)
    {
        return $this->uri->getUri($i);
    }

    /**
     * @param Uri $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return mixed
     */
    public function getDefaultRoute($i)
    {
        return $this->defaultRoute[$i];
    }

    /**
     * @param mixed $defaultRoute
     */
    public function setDefaultRoute($defaultRoute)
    {
        $this->defaultRoute = $defaultRoute;
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


}