<?php
/**
 * Created by PhpStorm.
 * User: rogerio.lamarques
 * Date: 08/09/2016
 * Time: 15:34
 */

namespace Aplicacao\Controller;


use Lamarques\Authentication;
use Lamarques\Controller;

class LoginController extends Controller
{

    public function indexAction()
    {
        return $this->view([]);
    }

    public function logoutAction()
    {
        $auth = new Authentication($this->getEm(), $this->getSessao());
        $auth->logOf();
        header('location: /Aplicacao/Login');
    }

    public function loginAction()
    {
        //[usuario] => admin [senha] => admin123
        $usuario = [
            'usuario' => filter_input(INPUT_POST, 'usuario'),
            'senha' => md5(filter_input(INPUT_POST, 'senha')),
        ];
        $auth = new Authentication($this->getEm(), $this->getSessao());
        if($auth->logOn($usuario)){
            header('location: /');
        } else {
            header('location: /Aplicacao/Login');
        }
    }

}