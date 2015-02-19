<?php

namespace Intrix\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LayoutController extends Controller {

    public function navLeftAction($local) {
        return $this->render('BackendBundle:Layout:nav_left.html.twig');
    }

    public function navTopAction($local) {
        return $this->render('BackendBundle:Layout:nav_top.html.twig');
    }

}
