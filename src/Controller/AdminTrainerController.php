<?php

namespace App\Controller;

use App\Model\TrainerManager;

class AdminTrainerController extends AbstractController
{
    public function index(): string
    {
        $trainersManager = new TrainerManager();
        $trainers = $trainersManager->adminSelectAll();

        return $this->twig->render('admin/adminTrainer.html.twig', ['trainers' => $trainers]);
    }
}
