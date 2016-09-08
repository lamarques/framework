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
     * @var \Aplicacao\Entity\Sistema.usuarios
     *
     * @ORM\ManyToOne(targetEntity="Aplicacao\Entity\Sistema.usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuarios", referencedColumnName="id_usuarios")
     * })
     */
    private $idUsuarios;

    /**
     * @var \Aplicacao\Entity\Sistema.modulos
     *
     * @ORM\ManyToOne(targetEntity="Aplicacao\Entity\Sistema.modulos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_modulos", referencedColumnName="id_modulos")
     * })
     */
    private $idModulos;


}

