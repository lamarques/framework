<?php
/**
 * Created by PhpStorm.
 * User: rogerio.lamarques
 * Date: 08/09/2016
 * Time: 18:21
 */

namespace Lamarques;


use Aplicacao\Entity\SistemaUsuarios;
use Aplicacao\Entity\SistemaModulos;
use Aplicacao\Entity\SistemaPermissoes;
use Doctrine\ORM\EntityManager;

class Permissoes
{
    private $em;
    private $usuario;
    private $permissoes;

    public function __construct(EntityManager $em, SistemaUsuarios $usuario)
    {
        $this->em = $em;
        $this->usuario = $usuario;
        $this->setPemissoes();
    }

    public function setPemissoes()
    {
        $query = $this->em->createQuery('SELECT p, m FROM Aplicacao\Entity\SistemaPermissoes p JOIN p.idModulos m WHERE p.idUsuarios = ?1 ORDER  BY m.modulo ASC, m.ordem ASC');
        $query->setParameter(1, $this->usuario->getIdUsuarios());
        $query->execute();
        $this->permissoes = $query->getArrayResult();
    }

    public function getPermissoes()
    {
        return $this->permissoes;
    }



}