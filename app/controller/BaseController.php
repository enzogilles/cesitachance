<?php
// app/controller/BaseController.php

namespace app\controller;

class BaseController {
    protected $twig;

    public function __construct() {
        // Charge la configuration de Twig (assurez-vous que ce fichier existe et est correctement configuré)
        require_once __DIR__ . '/../config/twig.php';
        $this->twig = $twig;
    }

    /**
     * Méthode pour rendre un template Twig.
     *
     * @param string $template Chemin du template depuis le dossier view (ex: "home/index.twig")
     * @param array  $data     Variables à passer au template
     */
    protected function render($template, $data = []) {
        echo $this->twig->render($template, $data);
    }
}
