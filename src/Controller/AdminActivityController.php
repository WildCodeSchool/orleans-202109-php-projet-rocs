<?php

namespace App\Controller;

use App\Model\ActivityManager;

class AdminActivityController extends AbstractController
{
    public function index(): string
    {
        $activityManager = new ActivityManager();
        $activities = $activityManager->selectAllAdmin();

        return $this->twig->render('admin/adminActivityOverview.html.twig', ['activities' => $activities]);
    }
}
