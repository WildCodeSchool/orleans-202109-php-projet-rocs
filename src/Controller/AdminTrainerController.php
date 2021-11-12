<?php

namespace App\Controller;

use App\Model\TrainerManager;

class AdminTrainerController extends AbstractController
{
    public function edit(int $id): string
    {
        $trainerManager = new TrainerManager();
        $trainer = $trainerManager->selectOneById($id);
        $errors = $trainer = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $trainer = array_map('trim', $_POST);
            $errors = $this->trainerValidate($trainer);
            $trainer['id'] = $id;

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
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
        if (empty($trainer['firstname'])) {
            $errors[] = 'Le prénom est obligatoire';
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
