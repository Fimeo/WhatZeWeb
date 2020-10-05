<?php


namespace App\config;

/**
 * Class Request, gère la requête et les données POST, GET et SESSION
 * @package App\config
 */
class Request
{
    private Parameter $get;
    private Parameter $post;
    private $session;

    public function __construct()
    {
        $this->get = new Parameter($_GET);
        $this->post = new Parameter($_POST);
        $this->session = $_SESSION;
    }

    /**
     * Renvoie les données de la superglobale GET
     * @return Parameter Superglobale GET
     */
    public function getGet()
    {
        return $this->get;
    }

    /**
     * Renvoie les données de la superglobale POST
     * @return Parameter Superglobale POST
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Renvoie les données de la superglobale SESSION
     * @return array Superglobale SESSION
     */
    public function getSession()
    {
        return $this->session;
    }
}