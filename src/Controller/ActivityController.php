<?php

namespace App\Controller;

class ActivityController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Activity/index.html.twig');
    }
}
