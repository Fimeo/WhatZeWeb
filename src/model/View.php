<?php

namespace App\src\model;

use App\config\Request;
use App\config\Session;

/**
 * Class View s'occupe de la gestion des vues
 * @package App\src\model
 */
class View
{
    private string $file;
    private string $title;
    private Request $request;
    private Session $session;

    public function __construct()
    {
        $this->request = new Request();
        $this->session = $this->request->getSession();
    }

    /**
     * Création de la vue associée au template demandé,
     * données à afficher dans array data.
     *
     * @param $template string Nom du template à afficher dans la vue
     * @param array $data Données à afficher dans le template
     */
    public function render(string $template, $data = [])
    {
        //Création de la vue à partir de la base.php
        $this->file = '../templates/' . $template . ".php";
        $content = $this->renderFile($this->file, $data);
        $view = $this->renderFile('../templates/base.php', [
            'title' => $this->title,
            'content' => $content
        ]);
        echo $view;
    }

    /**
     * Rendu d'un fichier avec ses données.
     * @param $file string Nom du fichier à inclure
     * @param $data array Données à afficher dans le template
     * @return false|string
     */
    private function renderFile(string $file, array $data)
    {
        if (file_exists($file)) {
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        }
        header('Location: index.php?route=notFound');
    }
}