<?php

namespace Aplicacao\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sistema.permissoes
 *
 * @ORM\Table(name="sistema.permissoes", indexes={@ORM\Index(name="IDX_9433307F5E2D6B67", columns={"id_usuarios"}), @ORM\Index(name="IDX_9433307FAC5022D", columns={"id_modulos"})})
 * @ORM\Entity
 */
class SistemaPermissoes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_permissoes", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sistema.permissoes_id_permissoes_seq", allocationSize=1, initialValue=1)
     */
    private $idPermissoes;

    /**
     * @var boolean
     *
     * @ORM\Column(name="leitura", type="boolean", nullable=true)
     */
    private $leitura = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="escrita", type="boolean", nullable=true)
     */
    private $escrita = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="especial", type="boolean", nullable=true)
     */
    private $especial = false;

    /**
     * @var \Aplicacao\Entity\SistemaUsuarios
     *
     * @ORM\ManyToOne(targetEntity="Aplicacao\Entity\SistemaUsuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuarios", referencedColumnName="id_usuarios")
     * })
     */
    private $idUsuarios;

    /**
     * @var \Aplicacao\Entity\SistemaModulos
     *
     * @ORM\ManyToOne(targetEntity="Aplicacao\Entity\SistemaModulos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_modulos", referencedColumnName="id_modulos")
     * })
     */
    private $idModulos;

    /**
     * @return int
     */
    public function getIdPermissoes()
    {
        return $this->idPermissoes;
    }

    /**
     * @param int $idPermissoes
     * @return SistemaPermissoes
     */
    public function setIdPermissoes($idPermissoes)
    {
        $this->idPermissoes = $idPermissoes;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isLeitura()
    {
        return $this->leitura;
    }

    /**
     * @param boolean $leitura
     * @return SistemaPermissoes
     */
    public function setLeitura($leitura)
    {
        $this->leitura = $leitura;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isEscrita()
    {
        return $this->escrita;
    }

    /**
     * @param boolean $escrita
     * @return SistemaPermissoes
     */
    public function setEscrita($escrita)
    {
        $this->escrita = $escrita;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isEspecial()
    {
        return $this->especial;
    }

    /**
     * @param boolean $especial
     * @return SistemaPermissoes
     */
    public function setEspecial($especial)
    {
        $this->especial = $especial;
        return $this;
    }

    /**
     * @return SistemaUsuarios
     */
    public function getIdUsuarios()
    {
        return $this->idUsuarios;
    }

    /**
     * @param SistemaUsuarios $idUsuarios
     * @return SistemaPermissoes
     */
    public function setIdUsuarios($idUsuarios)
    {
        $this->idUsuarios = $idUsuarios;
        return $this;
    }

    /**
     * @return SistemaModulos
     */
    public function getIdModulos()
    {
        return $this->idModulos;
    }

    /**
     * @param SistemaModulos $idModulos
     * @return SistemaPermissoes
     */
    public function setIdModulos($idModulos)
    {
        $this->idModulos = $idModulos;
        return $this;
    }



}

