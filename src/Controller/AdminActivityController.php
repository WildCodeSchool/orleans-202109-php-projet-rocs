<?php

namespace App\Controller;

use App\Model\ActivityManager;
use App\Model\TrainerManager;

class AdminActivityController extends AbstractController
{
    public function index(): string
    {
        if (empty($_SESSION)) {
            header('Location: /admin/erreur');
        }
        $activityManager = new ActivityManager();

        $activities = $activityManager->selectAllWithTrainer();

        return $this->twig->render('admin/adminActivityOverview.html.twig', ['activities' => $activities]);
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $activityManager = new ActivityManager();
            $activityManager->delete((int)$_POST['id']);
            header('Location: /admin/activites');
        }
    }

    public function add(): string
    {
        $trainerManager = new TrainerManager();
        $trainers = $trainerManager->selectAll();

        $errors = [];
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            $errors = $this->validate($data, $trainers);
            if (empty($errors)) {
                $activityManager = new ActivityManager();
                $activityManager->addActivity($data);
                header('Location: /admin/activites');
            }
        }
        return $this->twig->render(
            'admin/adminAddActivity.html.twig',
            [
                'trainers' => $trainers,
                'errors' => $errors,
                'data' => $data,
            ]
        );
    }

    public function modify(int $id): string
    {
        $activityManager = new ActivityManager();
        $activity = $activityManager->activityById($id);
        $trainerManager = new TrainerManager();
        $trainers = $trainerManager->selectAll('lastname');
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $activity = array_map('trim', $_POST);
            $activity['id'] = $id;
            $errors = $this->validate($activity, $trainers);
            if (empty($errors)) {
                $activityManager->modifyActivity($activity);
                header('Location: /admin/activites');
            }
        }
        return $this->twig->render(
            'admin/adminEditActivity.html.twig',
            [
                'data' => $activity,
                'trainers' => $trainers,
                'errors' => $errors,
            ]
        );
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    private function validate(array $data, array $trainers): array
    {
        $errors = [];
        if (empty($data['name'])) {
            $errors['emptyActivity'] = 'Le champs "Activité" ne peut être vide';
        }

        $maxActivityLength = 100;
        if (strlen($data['name']) >= $maxActivityLength) {
            $errors['toLongActivity'] = 'Le champ "Activité" ne peut être plus long que ' . $maxActivityLength;
        }

        if (empty($data['description'])) {
            $errors['emptyDescription'] = 'Le champ "Description" ne peut être vide';
        }

        if (empty($data['schedule'])) {
            $errors['emptySchedule'] = 'Le champ "Horraires" ne peut être vide';
        }

        $maxScheduleLength = 155;
        if (strlen($data['schedule']) >= $maxScheduleLength) {
            $errors['toLongSchedule'] = 'Le champ "Horraires" ne peut être plus long que ' . $maxScheduleLength;
        }

        if (empty($data['days'])) {
            $errors['emptyDays'] = 'Le champ "Jours" ne peut être vide';
        }

        $maxDaysLength = 155;
        if (strlen($data['days']) >= $maxDaysLength) {
            $errors['toLongDays'] = 'Le champ "Jours" ne peut être plus long que ' . $maxDaysLength;
        }

        if (empty($data['who'])) {
            $errors['emptyWho'] = 'Le champ "Pour qui" ne peut être vide';
        }

        if (!in_array($data['trainer'], array_column($trainers, 'id')) && $data['trainer'] != '') {
            $errors['noTrainer'] = 'L\'entraîneur sélectionné est introuvable';
        }
        return $errors;
    }
}
