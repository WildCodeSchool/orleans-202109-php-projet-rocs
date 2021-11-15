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
    public function show(int $id): string
    {
        $activityManager = new ActivityManager();
        $activity = $activityManager->activityById($id);
        return $this->twig->render('Activity/activity.html.twig', ['activity' => $activity]);
    }
}
