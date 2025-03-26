<?php
// app/controller/MentionsLegalesController.php

namespace app\controller;

use app\controller\BaseController;

class MentionsLegalesController extends BaseController {

    public function mentions() {
        $this->render('mentions_legales/mentions.php');
    }

    public function conditions() {
        $this->render('mentions_legales/conditions.php');
    }

    public function confidentialite() {
        $this->render('mentions_legales/confidentialite.php');
    }
}
