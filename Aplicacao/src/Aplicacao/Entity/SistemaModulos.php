<?php

namespace Aplicacao\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sistema.modulos
 *
 * @ORM\Table(name="sistema.modulos")
 * @ORM\Entity
 */
class SistemaModulos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_modulos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sistema.modulos_id_modulos_seq", allocationSize=1, initialValue=1)
     */
    private $idModulos;

    /**
     * @var string
     *
     * @ORM\Column(name="modulo", type="string", length=255, nullable=false)
     */
    private $modulo = "Geral";

    /**
     * @var string
     *
     * @ORM\Column(name="menu", type="string", length=255, nullable=false)
     */
    private $menu;

    /**
     * @var string
     *
     * @ORM\Column(name="href", type="string", length=255, nullable=false)
     */
    private $href;

    /**
     * @var boolean
     *
     * @ORM\Column(name="exibir", type="boolean", nullable=true)
     */
    private $exibir = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordem", type="integer", nullable=true)
     */
    private $ordem;

    /**
     * @return int
     */
    public function getIdModulos()
    {
        return $this->idModulos;
    }

    /**
     * @param int $idModulos
     * @return $this
     */
    public function setIdModulos($idModulos)
    {
        $this->idModulos = $idModulos;
        return $this;
    }

    /**
     * @return string
     */
    public function getModulo()
    {
        return $this->modulo;
    }

    /**
     * @param string $modulo
     * @return $this
     */
    public function setModulo($modulo)
    {
        $this->modulo = $modulo;
        return $this;
    }

    /**
     * @return string
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @param string $menu
     * @return $this
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
        return $this;
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @param string $href
     * @return $this
     */
    public function setHref($href)
    {
        $this->href = $href;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isExibir()
    {
        return $this->exibir;
    }

    /**
     * @param boolean $exibir
     * @return $this
     */
    public function setExibir($exibir)
    {
        $this->exibir = (bool)$exibir;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrdem()
    {
        return $this->ordem;
    }

    /**
     * @param int $order
     * @return $this
     */
    public function setOrdem($ordem)
    {
        $this->ordem = $ordem;
        return $this;
    }



}

