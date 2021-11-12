<?php

namespace App\Controller;

use App\Model\ActivityManager;

class AdminActivityController extends AbstractController
{
    public function index(): string
    {
        $activityManager = new ActivityManager();
        $activities = $activityManager->selectAllWithTrainer();

        return $this->twig->render('admin/adminActivityOverview.html.twig', ['activities' => $activities]);
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $activityManager = new ActivityManager();
            $activityManager->delete((int)$_POST['activity_id']);
            header('Location: /admin/activites');
        }
    }
}
