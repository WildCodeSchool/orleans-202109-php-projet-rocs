<?php

namespace App\Controller;

use App\Model\ActivityManager;

class AdminActivityController extends AbstractController
{
    public function index(): string
    {
        if (empty($_SESSION)) {
            header('Location: /admin/erreur');
        }
        $activityManager = new ActivityManager();
        $activities = $activityManager->selectAllAdmin();
        return $this->twig->render('admin/adminActivityOverview.html.twig', ['activities' => $activities]);
    }
}
