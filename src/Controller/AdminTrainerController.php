<?php

namespace App\Controller;

use App\Model\TrainerManager;

class AdminTrainerController extends AbstractController
{
    public function edit(int $id): string
    {
        $errors = $trainer = [];
        $trainerManager = new TrainerManager();
        $trainer = $trainerManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $trainer = array_map('trim', $_POST);
            $errors = $this->trainerValidate($trainer);
            $trainer['id'] = $id;
            if (empty($errors)) {
                $trainerManager->update($trainer);
                header('Location: /admin/entraineur');
            }
        }

        return $this->twig->render('admin/adminEditTrainer.html.twig', ['errors' => $errors, 'trainer' => $trainer]);
    }


    private function trainerValidate(array $trainer): array
    {
        $errors = [];
        if (empty($trainer['lastname'])) {
            $errors[] = 'Le nom est obligatoire';
        }
        $maxLastnameLength = 155;
        if (strlen($trainer['lastname']) > $maxLastnameLength) {
            $errors[] = 'Le champ nom ne peut être plus long que ' . $maxLastnameLength;
        }
        if (empty($trainer['firstname'])) {
            $errors[] = 'Le prénom est obligatoire';
        }
        $maxfirstnameLength = 155;
        if (strlen($trainer['firstname']) > $maxfirstnameLength) {
            $errors[] = 'Le champ prénom ne peut être plus long que ' . $maxfirstnameLength;
        }
        if (empty($trainer['phoneNumber'])) {
            $errors[] = 'Le téléphone est obligatoire';
        }
        if (empty($trainer['email'])) {
            $errors[] = 'Le mail est obligatoire';
        } elseif (!filter_var($trainer['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'L\'adresse mail n\'est pas au bon format';
        }
        return $errors;
    }
}
