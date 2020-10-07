<?php


namespace App\src\controller;

use App\config\Parameter;
use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\model\View;
use App\config\Request;
use App\src\constraint\Validation;
use App\config\Session;

/**
 * Class Controller abstraite, généralisation de  l'usage des controlleurs
 * @package App\src\controller
 */
abstract class Controller
{
    protected ArticleDAO $articleDAO;
    protected CommentDAO $commentDAO;
    protected View $view;
    private Request $request;
    protected Parameter $get;
    protected Parameter $post;
    protected Session $session;
    protected Validation $validation;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->view = new View();
        $this->request = new Request();
        $this->validation = new Validation();
        $this->get = $this->request->getGet();
        $this->post = $this->request->getPost();
        $this->session = $this->request->getSession();
    }
}