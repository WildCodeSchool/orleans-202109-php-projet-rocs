<?php

namespace App\Controller;

use App\Model\TrainerManager;

class AdminTrainerController extends AbstractController
{
    public function index(): string
    {
        $trainerManager = new TrainerManager();
        $trainers = $trainerManager->selectAll('lastname');

        return $this->twig->render('admin/adminTrainer.html.twig', ['trainers' => $trainers]);
    }
}
