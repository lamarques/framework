<?php
/**
 * Created by PhpStorm.
 * User: rogerio.lamarques
 * Date: 08/09/2016
 * Time: 14:32
 */

namespace Lamarques;


class Session
{

    /**
     * @var string $session_name
     */
    private $session_name = null;
    private $session;

    public function __construct($session_name = null)
    {
        $this->setSessionName($session_name);
        if(session_id() == '' || !isset($_SESSION)) {
            session_start();
            if($this->getSessionName() !== null){
                session_name ($this->getSessionName());
            }
        }
        $this->setSession($_SESSION);
    }

    /**
     * @return string
     */
    public function getSessionName()
    {
        return $this->session_name;
    }

    /**
     * @param string $session_name
     */
    public function setSessionName($session_name = '')
    {
        $this->session_name = $session_name;
    }

    /**
     * @return array
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param array $session
     */
    public function setSession(array $session)
    {
        $_SESSION = $session;
        $this->session =(array) $session;
    }

    public function destroySession(){
        session_unset ();
        session_destroy();
    }



}