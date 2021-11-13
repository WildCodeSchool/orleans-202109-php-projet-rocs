<?php

namespace App\Controller;

use App\Model\TrainerManager;

class AdminTrainerController extends AbstractController
{
    public function index(): string
    {
        $trainersManager = new TrainerManager();
        $trainers = $trainersManager->SelectAll();

        return $this->twig->render('admin/adminTrainer.html.twig', ['trainers' => $trainers]);
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $trainerManager = new TrainerManager();
            $trainerManager->delete((int)$id);
            header('Location: /admin/entraineur');
        }
    }
}
