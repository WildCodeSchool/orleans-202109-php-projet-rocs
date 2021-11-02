<?php

namespace App\Controller;

use App\Model\ActivityManager;

class ActivityController extends AbstractController
{
    public function show(int $id): string
    {
        $activityManager = new ActivityManager();
        $activity = $activityManager->selectOneById($id);

        return $this->twig->render('Activity/activity.html.twig', ['activity' => $activity]);
    }
}