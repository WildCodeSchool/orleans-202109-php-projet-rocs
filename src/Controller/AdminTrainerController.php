<?php

namespace App\Controller;

use App\Model\TrainerManager;

class AdminTrainerController extends AbstractController
{
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
