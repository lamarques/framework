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

    /**
     * View constructor.
     * @param string $dir
     */
    public function __construct(array $state)
    {
        parent::__construct(__DIR__ . '/../../../' . ucfirst($state['module']) . '/src/' . ucfirst($state['module']) . '/View/' . $state['controller'], 'phtml');
        $this->action = $state['action'];
    }

    public function view($data){
        echo $this->render($this->action, $data);
        return true;
    }

}