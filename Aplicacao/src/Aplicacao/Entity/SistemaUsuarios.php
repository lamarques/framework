<?php

namespace Aplicacao\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sistema.usuarios
 *
 * @ORM\Table(name="sistema.usuarios")
 * @ORM\Entity
 */
class SistemaUsuarios
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_usuarios", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sistema.usuarios_id_seq", allocationSize=1, initialValue=1)
     */
    private $idUsuarios;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=255, nullable=false)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="senha", type="string", length=255, nullable=false)
     */
    private $senha;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ativo", type="boolean", nullable=true)
     */
    private $ativo = true;

    /**
     * @return int
     */
    public function getIdUsuarios()
    {
        return $this->idUsuarios;
    }

    /**
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @return string
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return boolean
     */
    public function isAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param int $idUsuarios
     * @return SistemaUsuarios
     */
    public function setIdUsuarios($idUsuarios)
    {
        $this->idUsuarios = $idUsuarios;
        return $this;
    }

    /**
     * @param string $usuario
     * @return SistemaUsuarios
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }

    /**
     * @param string $senha
     * @return SistemaUsuarios
     */
    public function setSenha($senha)
    {
        $this->senha = md5($senha);
        return $this;
    }

    /**
     * @param string $email
     * @return SistemaUsuarios
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param boolean $ativo
     * @return SistemaUsuarios
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
        return $this;
    }




}

