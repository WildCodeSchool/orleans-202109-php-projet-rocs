<?php

namespace App\Controller;

use App\Model\TrainerManager;

class AdminTrainerController extends AbstractController
{

    public function index(): string
    {
        if (!isset($_SESSION['username'])) {
            header('Location: /admin/erreur');
        }
        $trainersManager = new TrainerManager();
        $trainers = $trainersManager->selectAll('lastname');

        return $this->twig->render('admin/adminTrainer.html.twig', ['trainers' => $trainers]);
    }




    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $trainerManager = new TrainerManager();
            $trainer = $trainerManager->selectOneById((int)$id);
            if (file_exists('uploads/trainers' . $trainer['image'])) {
                unlink('uploads/trainers' . $trainer['image']);
            }
            $trainerManager->delete((int)$id);
            header('Location: /admin/entraineur');
        }
    }
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



    public function add(): string
    {
        $errors = $trainer = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $trainer = array_map('trim', $_POST);

            $errors = $this->trainerValidate($trainer);

            if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                $maxFileSize = '1500000';
                if ($_FILES['image']['size'] > $maxFileSize) {
                    $errors[] = "L'image doit faire moins de " . $maxFileSize / 1000000 . "M";
                }
                $autorizedMimes = ['image/jpeg', 'image/png', 'image/jpg'];
                $fileMime = mime_content_type($_FILES['image']['tmp_name']);

                if (!in_array($fileMime, $autorizedMimes)) {
                    $errors[] = "Veuillez sélectionner une image de type " . implode(' , ', $autorizedMimes);
                }
            } else {
                $errors[] = "Probléme de téléchargement d'image";
            }

            if (empty($errors)) {
                $fileName = uniqid() . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/trainers/' . $fileName);
                $trainer['image'] = $fileName;
                $trainersManager = new TrainerManager();
                $trainersManager->insert($trainer);
                header('Location:/admin/entraineur');
            }
        }
        return $this->twig->render('admin/adminAddTrainer.html.twig', ['errors' => $errors, 'trainer' => $trainer]);
    }



    /**
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    private function trainerValidate(array $trainer): array
    {
        $errors = [];
        if (!isset($trainer['gender'])) {
            $errors[] = 'La civilité est obligatoire';
        }

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
        $maxFirstnameLength = 155;
        if (strlen($trainer['firstname']) > $maxFirstnameLength) {
            $errors[] = 'Le champ prénom ne peut être plus long que ' . $maxFirstnameLength;
        }

        $maxPhoneLenght = 10 ;

        if (empty($trainer['phoneNumber'])) {
            $errors[] = 'Le téléphone est obligatoire';
        } elseif (strlen($trainer['phoneNumber']) > $maxPhoneLenght) {
            $errors[] = 'Le numéro de téléphone est invalide';
        }
        if (empty($trainer['email'])) {
            $errors[] = 'Le mail est obligatoire';
        } elseif (!filter_var($trainer['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'L\'adresse mail n\'est pas au bon format';
        }
        return $errors;
    }
}
