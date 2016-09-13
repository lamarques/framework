<?php
/**
 * Created by PhpStorm.
 * User: rogerio.lamarques
 * Date: 05/09/2016
 * Time: 14:52
 */

namespace Aplicacao\Controller;


use Lamarques\Authentication;
use Lamarques\Controller;

class IndexController extends Controller
{

    public function __construct(array $config, $client, $uri)
    {
        parent::__construct($config, $client, $uri);
        $auth = new Authentication($this->getEm(), $this->getSessao());
        if(!$auth->isLogged()){
            $auth->logOf();
            header('location: /Aplicacao/Login');
        }
    }

    public function indexAction(){
        $em = $this->getEm();
        $usuarios = $em->getRepository('Aplicacao\Entity\SistemaUsuarios');
        $dados = $usuarios->findAll();
        return $this->view([
//            'dados' => $dados,
//            'sessao' => $this->getSessao(),
        ]);
    }

}