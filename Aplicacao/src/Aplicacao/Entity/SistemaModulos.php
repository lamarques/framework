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
     * @ORM\Column(name="order", type="integer", nullable=true)
     */
    private $order;

}

