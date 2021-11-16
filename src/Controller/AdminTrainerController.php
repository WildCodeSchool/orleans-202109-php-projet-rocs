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
/*   public function add(): string
    {
        $errors = $trainer = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $trainer = array_map('trim', $_POST);
            $errors = $this->trainerValidate($trainer);
            if (empty($errors)) {
                move_uploaded_file($_FILES['image']['tmp_name'],'/uploads/trainers'.uniqid().$_FILES['image']['tmp_name']);
                $trainersManager  = new TrainerManager();
                $trainersManager->insert($trainer);
                header('Location:/admin/entraineur');
            }
        }

        return $this->twig->render('admin/adminAddTrainer.html.twig', ['errors' => $errors, 'trainer' => $trainer]);

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
        } elseif (!preg_match("#[0][6][- \.?]?([0-9][0-9][- \.?]?){4}$#",$trainer['phoneNumber'])){
            $errors[] = 'Le numéro de téléphone est invalide';
        }
        if (empty($trainer['email'])) {
            $errors[] = 'Le mail est obligatoire';
        } elseif (!filter_var($trainer['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'L\'adresse mail n\'est pas au bon format';
        }
        return $errors;
    }*/
}
