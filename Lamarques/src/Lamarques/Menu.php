<?php
/**
 * Created by PhpStorm.
 * User: rogerio.lamarques
 * Date: 09/09/2016
 * Time: 23:30
 */

namespace Lamarques;


class Menu
{

    private $menu = [];

    /**
     * Menu constructor.
     * @param array $menu
     */
    public function __construct(array $menu)
    {
        $menus = [];
        foreach ($menu as $m){
            if($m['leitura'] && $m['idModulos']['exibir']){
                $menus[$m['idModulos']['modulo']][] = [
                    "menu" => $m['idModulos']['menu'],
                    "href" => $m['idModulos']['href']
                ];
            }
        }
        $this->setMenu($menus);
    }


    /**
     * @return array
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @param array $menu
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
    }



}