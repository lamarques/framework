<?php
/**
 * Created by PhpStorm.
 * User: rogerio.lamarques
 * Date: 13/09/2016
 * Time: 11:07
 */

namespace Lamarques;


use Aplicacao\Entity\SistemaModulos;
use Aplicacao\Entity\SistemaUsuarios;
use Doctrine\ORM\EntityManager;

class PermissoesAcesso
{

    public static function getPermissaoModulo(EntityManager $em, $idModulo,array $sessao){
        if($idModulo) {
            $usuariosRepository = $em->getRepository('Aplicacao\Entity\SistemaUsuarios');
            $idUsuarios = $sessao['id_usuario'];
            $modulosRepository = $em->getRepository('Aplicacao\Entity\SistemaModulos');
            /**
             * @var SistemaUsuarios $usuario
             */
            $usuario = $usuariosRepository->find($idUsuarios);
            /**
             * @var SistemaModulos $modulos
             */
            $modulos = $modulosRepository->find($idModulo);
            $query = $em->createQuery('SELECT p, m FROM Aplicacao\Entity\SistemaPermissoes p JOIN p.idModulos m WHERE p.idUsuarios = ?1 AND m.idModulos = ?2');
            $query->setParameter(1, $usuario->getIdUsuarios());
            $query->setParameter(2, $modulos->getIdModulos());
            $query->execute();
            $dados = $query->getOneOrNullResult();
            if(!empty($dados)){
                return $dados;
            }
        }
        return false;
    }

}