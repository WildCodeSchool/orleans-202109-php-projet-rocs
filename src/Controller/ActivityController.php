<?php

namespace App\Controller;

class ActivityController extends AbstractController
{
    public function show(int $id): string
    {
        return $this->twig->render('Activity/activity.html.twig');
    }
}