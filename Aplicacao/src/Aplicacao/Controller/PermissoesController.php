<?php
/**
 * Created by PhpStorm.
 * User: rogerio.lamarques
 * Date: 11/09/2016
 * Time: 15:38
 */

namespace Aplicacao\Controller;


use Aplicacao\Entity\SistemaPermissoes;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Lamarques\Authentication;
use Lamarques\Controller;

class PermissoesController extends Controller
{
    public function __construct(array $config, $client, $uri)
    {
        parent::__construct($config, $client, $uri);
        $auth = new Authentication($this->getEm(), $this->getSessao());
        if (!$auth->isLogged()) {
            $auth->logOf();
            header('location: /Aplicacao/Login');
        }
    }

    public function indexAction()
    {
        $idUsuarios = $this->getParams('param_0');
        $em = $this->getEm();
        $sql = "SELECT 
                    m.id_modulos,
                    p.id_permissoes,
                    m.href,
                    m.menu,
                    m.modulo,
                    p.leitura,
                    p.escrita,
                    p.especial
                FROM sistema.modulos m
                LEFT JOIN sistema.permissoes p ON m.id_modulos = p.id_modulos AND p.id_usuarios = ?
                ORDER BY m.modulo ASC";
        $query = $em->getConnection()->prepare($sql);
        $query->bindParam(1, $idUsuarios);
        $query->execute();
        $dados = $query->fetchAll();
        return $this->view([
            'idUsuarios' => $idUsuarios,
            'dados' => $dados
        ]);
    }

    public function updateAction()
    {
        $resposta['resultado'] = 'nao';
        try {
            $em = $this->getEm();
            $id_usuarios = filter_input(INPUT_POST, 'id_usuarios');
            $usuariosRepository = $em->getRepository('Aplicacao\Entity\SistemaUsuarios');
            $usuarios = $usuariosRepository->find($id_usuarios);
            $id_modulos = filter_input(INPUT_POST, 'id_modulos');
            $modulosRepository = $em->getRepository('Aplicacao\Entity\SistemaModulos');
            $modulos = $modulosRepository->find($id_modulos);
            $id_permissoes = filter_input(INPUT_POST, 'id_permissoes');
            $campo = filter_input(INPUT_POST, 'campo');
            $op = filter_input(INPUT_POST, 'op');
            $op = ($op === 'true') ? true : false;
            if (!empty($id_permissoes)) {
                $permissoesRepository = $em->getRepository('Aplicacao\Entity\SistemaPermissoes');
                $permissoes = $permissoesRepository->find($id_permissoes);
            } else {
                $permissoes = new SistemaPermissoes();
            }
            $permissoes->setIdUsuarios($usuarios);
            $permissoes->setIdModulos($modulos);
            switch ($campo) {
                case 'leitura':
                    $permissoes->setLeitura($op);
                    break;
                case 'escrita':
                    $permissoes->setEscrita($op);
                    break;
                case 'especial':
                    $permissoes->setEspecial($op);
                    break;
            }
            $em->persist($permissoes);
            $em->flush();
            $resposta['resultado'] = 'sim';
            $resposta['id_permissoes'] = $permissoes->getIdPermissoes();
        } catch (\Exception $e) {
            $resposta['erro'] = $e->getMessage();
        }
        echo json_encode($resposta);
    }

}