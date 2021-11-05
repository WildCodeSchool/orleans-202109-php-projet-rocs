<?php

namespace App\Controller;

use App\Model\ActivityManager;

class ActivityController extends AbstractController
{
    public function index()
    {
        $activityManager = new ActivityManager();
        $activities = $activityManager->selectAll();
        return $this->twig->render('Activity/index.html.twig', ['activities' => $activities]);
    }
}
