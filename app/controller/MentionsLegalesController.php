<?php
// app/controller/MentionsLegalesController.php

namespace app\controller;

use app\controller\BaseController;

class MentionsLegalesController extends BaseController {

    public function mentions() {
        $this->render('mentions_legales/mentions.twig');
    }

    public function conditions() {
        $this->render('mentions_legales/conditions.twig');
    }

    public function confidentialite() {
        $this->render('mentions_legales/confidentialite.twig');
    }
}
