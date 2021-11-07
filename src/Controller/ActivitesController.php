<?php

namespace App\Controller;

use App\Model\ActivitesManager;

class ActivitesController extends AbstractController
{
    public function index()
    {
        $activitesManager = new ActivitesManager();
        $activities = $activitesManager->selectAll();
        return $this->twig->render('Activites/index.html.twig', ['activities' => $activities]);
    }
}
