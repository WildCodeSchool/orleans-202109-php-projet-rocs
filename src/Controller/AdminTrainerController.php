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



    public function add(): string
    {
        $errors = $trainer = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $trainer = array_map('trim', $_POST);
            $errors = $this->trainerValidate($trainer);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            if (empty($errors)) {
                $trainersManager  = new TrainerManager();
                $trainersManager->insert($trainer);
                header('Location:/admin/entraineur');
            }
        }

        return $this->twig->render('admin/adminAddTrainer.html.twig', ['errors' => $errors, 'trainer' => $trainer]);
    }

    private function trainerValidate(array $trainer): array
    {
        $errors = [];
        if (empty($trainer['lastname'])) {
            $errors[] = 'Le nom est obligatoire';
        }
        if (empty($trainer['firstname'])) {
            $errors[] = 'Le prénom est obligatoire';
        }
        $maxphoneNumberLength = 10;
        if (empty($trainer['phoneNumber'])) {
            $errors[] = 'Le téléphone est obligatoire';
        } elseif ($trainer['phoneNumber'] > $maxphoneNumberLength || $trainer['phoneNumber'] < $maxphoneNumberLength) {
            $errors[] = 'Téléphone invalide';
        }
        if (empty($trainer['email'])) {
            $errors[] = 'Le mail est obligatoire';
        } elseif (!filter_var($trainer['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'L\'adresse mail n\'est pas au bon format';
        }
        return $errors;
    }
}
