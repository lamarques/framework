<?php
/**
 * Created by PhpStorm.
 * User: rogerio.lamarques
 * Date: 05/09/2016
 * Time: 14:52
 */

namespace Aplicacao\Controller;


use Lamarques\Controller;

class IndexController extends Controller
{

    public function indexAction(){
        return $this->view(['nome' => 'joao da cruz']);
    }

    public function loginAction(){
        return $this->view(['nome' => 'joao da cruz']);
    }

}