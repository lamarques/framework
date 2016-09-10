<?php
/**
 * Created by PhpStorm.
 * User: rogerio.lamarques
 * Date: 10/09/2016
 * Time: 01:34
 */

namespace Aplicacao\Controller;

use Aplicacao\Entity\SistemaModulos;
use Lamarques\Authentication;
use Lamarques\Controller;

class ModulosController extends Controller
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
        $modulos = $em->getRepository('Aplicacao\Entity\SistemaModulos');
        $dados = $modulos->findAll();
        return $this->view(['dados'=>$dados]);
    }

    public function addAction(){
        $acao = $this->getParams('param_0');
        $modulos = new SistemaModulos();
        $err = false;
        if($acao === 'salvar'){
            $modulo = filter_input(INPUT_POST, 'modulo');
            $menu =  filter_input(INPUT_POST, 'menu');
            $href =  filter_input(INPUT_POST, 'href');
            $ordem = filter_input(INPUT_POST, 'ordem');
            $exibir = filter_input(INPUT_POST, 'exibir');
            $exibir = ($exibir) ? true : false;
            $modulos->setModulo($modulo)
                ->setMenu($menu)
                ->setHref($href)
                ->setExibir($exibir)
                ->setOrdem($ordem);
            $em = $this->getEm();
            $em->persist($modulos);
            $em->flush();
            header("location: /aplicacao/modulos");
        }
        return $this->view(['modulo' => $modulos, 'err' => $err]);
    }

    public function editAction(){
        $id_modulos = $this->getParams('param_0');
        $acao = $this->getParams('param_1');
        $em = $this->getEm();
        $repModulos = $em->getRepository('Aplicacao\Entity\SistemaModulos');
        if($acao === 'salvar'){
            $id_modulos = filter_input(INPUT_POST, 'idModulos');
            $modulo = filter_input(INPUT_POST, 'modulo');
            $menu =  filter_input(INPUT_POST, 'menu');
            $href =  filter_input(INPUT_POST, 'href');
            $ordem = filter_input(INPUT_POST, 'ordem');
            $exibir = filter_input(INPUT_POST, 'exibir');
            $exibir = ($exibir) ? true : false;
            $modulos = $repModulos->find($id_modulos);
            $modulos
                ->setIdModulos($id_modulos)
                ->setModulo($modulo)
                ->setMenu($menu)
                ->setHref($href)
                ->setExibir($exibir)
                ->setOrdem((empty($ordem)) ? null : $ordem);
            $em->persist($modulos);
            $em->flush();
            header("location: /aplicacao/modulos");
        } else {
            $modulos = $repModulos->find($id_modulos);
        }
        return $this->view(['modulo' => $modulos]);
    }

    public function deleteAction(){
        $idModulos = $this->getParams('param_0');
        $em = $this->getEm();
        $modulos = $em->getRepository('Aplicacao\Entity\SistemaModulos')->find($idModulos);
        $em->remove($modulos);
        $em->flush();
        header("location: /aplicacao/modulos");
    }

}