<?php
/**
 * Created by PhpStorm.
 * User: rogerio.lamarques
 * Date: 05/09/2016
 * Time: 15:12
 */

namespace Lamarques;


class Uri
{

    private $uri;
    private $client;
    private $host;
    public $href;

    public function __construct()
    {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $this->href = $_SERVER['REQUEST_URI'];
        if(isset($uri[1]))
            $this->setUri('module', $uri[1]);
        if(isset($uri[2]))
            $this->setUri('controller', $uri[2]);
        if(isset($uri[3]))
            $this->setUri('action', $uri[3]);
        for($i = 4; !empty($uri[$i]); $i++){
            $this->setUri('param_' . ($i-4), $uri[$i]);
        }
        $this->setHost($_SERVER['HTTP_HOST']);
        $host = explode('.', $_SERVER['HTTP_HOST']);
        $this->setClient($host[0]);
    }

    /**
     * @return mixed
     */
    public function getUri($param)
    {
        return (isset($this->uri[$param])) ? $this->uri[$param] : false;
    }

    /**
     * @param mixed $uri
     * @return Uri
     */
    public function setUri($param, $uri)
    {
        $this->uri[$param] = $uri;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     * @return Uri
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }





}