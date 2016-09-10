<?php
/**
 * Created by PhpStorm.
 * User: rogerio.lamarques
 * Date: 05/09/2016
 * Time: 17:15
 */

namespace Lamarques;


use League\Plates\Engine;

class View extends Engine
{
    public $action = '';
    public $globalData = [];

    /**
     * View constructor.
     * @param array $state
     */
    public function __construct(array $state)
    {
        parent::__construct(__DIR__ . '/../../../' . ucfirst($state['module']) . '/src/' . ucfirst($state['module']) . '/View/' . $state['controller'], 'phtml');
        $this->action = $state['action'];
    }

    public function view($data)
    {
        $data = array_merge($data, $this->getGlobalData());
        echo $this->render($this->action, $data);
        return true;
    }

    public function renderTemplate($template){
        $this->setDirectory(__DIR__ . "/../../../Aplicacao/src/Aplicacao/View/partials/");
        $this->renderTemplate($template);
    }

    /**
     * @return array
     */
    public function getGlobalData()
    {
        return $this->globalData;
    }

    /**
     * @param array $globalData
     */
    public function setGlobalData($key, $data)
    {
        $this->globalData[$key] = $data;
    }


}