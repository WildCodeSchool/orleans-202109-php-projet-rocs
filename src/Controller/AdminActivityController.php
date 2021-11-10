<?php

namespace App\Controller;

use App\Model\ActivityManager;
use App\Model\TrainerManager;

class AdminActivityController extends AbstractController
{
    public function index(): string
    {
        $activityManager = new ActivityManager();
        $activities = $activityManager->selectAllAdmin();

        return $this->twig->render('admin/adminActivityOverview.html.twig', ['activities' => $activities]);
    }

    public function add(): string
    {
        $trainerManager = new TrainerManager();
        $trainers = $trainerManager->selectAll();

        return $this->twig->render('admin/adminAddActivity.html.twig', ['trainers' => $trainers]);
    }
}
