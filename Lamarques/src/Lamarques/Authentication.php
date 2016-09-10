<?php
/**
 * Created by PhpStorm.
 * User: rogerio.lamarques
 * Date: 08/09/2016
 * Time: 14:44
 */

namespace Lamarques;


use Aplicacao\Entity\SistemaUsuarios;
use Doctrine\ORM\EntityManager;

class Authentication
{
    private $sessao;
    private $em;
    private $usuario;

    /**
     * authentication constructor.
     * @param Session $sessao
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em,Session $sessao)
    {
        $this->sessao = $sessao;
        $this->em = $em;
    }

    /**
     * @return bool
     */
    public function isLogged(){
        $sessaoAtiva = $this->sessao->getSession();
        if($sessaoAtiva['islogged'] && $sessaoAtiva['usuario'] && $sessaoAtiva['email']){
            return true;
        }
        return false;
    }

    /**
     * @param array $usuario
     * @return bool
     */
    public function logOn(array $usuario){
        $usuarios = $this->em->getRepository('Aplicacao\Entity\SistemaUsuarios');
        /**
         * @var \Aplicacao\Entity\SistemaUsuarios $dadosUsuario
         */
        $dadosUsuario = $usuarios->findOneBy($usuario);
        echo "<pre>";
        if($dadosUsuario->getIdUsuarios() && $dadosUsuario->isAtivo()){
            $permissoes = new Permissoes($this->em, $dadosUsuario);
            $this->sessao->setSession([
                'islogged' => true,
                'usuario' => $dadosUsuario->getUsuario(),
                'email' => $dadosUsuario->getEmail(),
                'permissoes' => $permissoes->getPermissoes()
            ]);
            return true;
        }
        return false;
    }

    public function logOf(){
        $this->sessao->destroySession();
        return true;
    }
}