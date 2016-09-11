<?php
/**
 * Created by PhpStorm.
 * User: rogerio.lamarques
 * Date: 10/09/2016
 * Time: 19:21
 */

namespace Aplicacao\Controller;


use Aplicacao\Entity\SistemaUsuarios;
use Lamarques\Authentication;
use Lamarques\Controller;

class UsuariosController extends Controller
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
        return $this->view(['dados' => $dados]);
    }

    public function addAction(){
        $acao = $this->getParams('param_0');
        if($acao === 'salvar'){
            $usuario = filter_input(INPUT_POST, 'usuario');
            $senha = filter_input(INPUT_POST, 'senha');
            $email = filter_input(INPUT_POST, 'email');
            $usuarios = new SistemaUsuarios();
            $usuarios->setUsuario($usuario)
                ->setSenha($senha)
                ->setEmail($email);
            $em = $this->getEm();
            $em->persist($usuarios);
            $em->flush();
            header("location: /aplicacao/usuarios");
        }
        return $this->view([]);
    }

    public function editAction(){
        $idUsuarios = $this->getParams('param_0');
        $acao = $this->getParams('param_1');
        $em = $this->getEm();
        $usuarios = $em->getRepository('Aplicacao\Entity\SistemaUsuarios');
        if($acao === 'salvar'){
            $idUsuarios = filter_input(INPUT_POST, 'idUsuarios');
            $usuario = filter_input(INPUT_POST, 'usuario');
            $senha = filter_input(INPUT_POST, 'senha');
            $email = filter_input(INPUT_POST, 'email');
            /**
             * @var SistemaUsuarios $dados
             */
            $dados = $usuarios->find($idUsuarios);
            $dados->setIdUsuarios($idUsuarios)
                ->setUsuario($usuario)
                ->setEmail($email);
            if(!empty($senha)){
                $dados->setSenha($senha);
            }
            $em->persist($dados);
            $em->flush();
            header("location: /aplicacao/usuarios");
        } else {
            $dados = $usuarios->find($idUsuarios);
        }
        return $this->view(['usuario' => $dados]);
    }

    public function deleteAction(){
        $idUsuarios = $this->getParams('param_0');
        $em = $this->getEm();
        $usuarios = $em->getRepository('Aplicacao\Entity\SistemaUsuarios')->find($idUsuarios);
        $em->remove($usuarios);
        $em->flush();
        header("location: /aplicacao/usuarios");
    }

    public function passwordAction(){
        $idUsuarios = $this->getParams('param_0');
        $acao = $this->getParams('param_1');
        $em = $this->getEm();
        $usuarios = $em->getRepository('Aplicacao\Entity\SistemaUsuarios');
        if($acao === 'salvar'){
            $senhaLogado = filter_input(INPUT_POST, 'senhalogado');
            $idUsuarios = filter_input(INPUT_POST, 'idUsuarios');
            $senha = filter_input(INPUT_POST, 'senha');
            $sessao = $this->getSessao()->getSession();
            $usuarioSessao = $usuarios->findBy([
                'usuario' => $sessao['usuario'],
                'senha' => md5($senhaLogado)
            ]);
            if($usuarioSessao){
                /**
                 * @var SistemaUsuarios $dados
                 */
                $dados = $usuarios->find($idUsuarios);
                $dados->setIdUsuarios($idUsuarios);
                $dados->setSenha($senha);
                $em->persist($dados);
                $em->flush();
                header("location: /aplicacao/usuarios");
            } else {
                $dados = $usuarios->find($idUsuarios);
                return $this->view(['usuario' => $dados, 'msgError' => 'Senha do usuário logado nao confere.']);
            }

        } else {
            $dados = $usuarios->find($idUsuarios);
        }
        return $this->view(['usuario' => $dados]);
    }

}