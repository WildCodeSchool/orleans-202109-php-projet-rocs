<?php

namespace App\Controller;

use App\Model\ActivityManager;
use App\Model\TrainerManager;

class ActivityController extends AbstractController
{
    public function show(int $id): string
    {
        $activityManager = new ActivityManager();
        $activity = $activityManager->selectOneById($id);

        $trainerManager = new TrainerManager();
        $trainer = $trainerManager->selectOneById($activity['id']);
        return $this->twig->render('Activity/activity.html.twig', ['activity' => $activity, 'trainer' => $trainer]);
    }
}
