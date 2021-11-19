<?php

namespace App\Controller;

use App\Model\AdminManager;
use Exception;

class AdminController extends AbstractController
{
    public function adminConnection(): string
    {
        $adminManager = new AdminManager();
        $errors = [];
        $data = [];
        $admin = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array_map('trim', $_POST);
            $errors = $this->validate($data);
            try {
                $admin = $adminManager->selectOneAdmin($data['username']);
            } catch (Exception $e) {
                $errors['adminNotFound'] = $e->getMessage();
            }
            if (empty($errors)) {
                if (
                    password_verify($data['password'], $admin['password'])
                    && $admin['username'] == $data['username']
                ) {
                    $_SESSION['username'] = $data['username'];
                    header('Location: /admin/activites');
                } else {
                    $errors['notFind'] = 'L\'utilisateur n\'a pas été trouvé ou le mot de passe est erroné';
                }
            }
        }

        return $this->twig->render(
            'admin/connection.html.twig',
            [
                'errors' => $errors,
                'data' => $data,
                'connected' => false,
            ]
        );
    }

    public function adminDeconnection()
    {
        session_destroy();
        header('Location: /admin/connection');
    }

    public function error(): string
    {
        return $this->twig->render('admin/adminError.html.twig', ['connected' => false]);
    }

    private function validate(array $data): array
    {
        $errors = [];
        if (empty($data['username'])) {
            $errors['emptyUsername'] = 'Le champ "Utilisateur" est obligatoire';
        }

        if (empty($data['password'])) {
            $errors['emptyPassword'] = 'Le champ "Mot de Passe" est obligatoire';
        }

        $maxUsernameLength = 100;
        if (strlen($data['username']) >= $maxUsernameLength) {
            $errors['toLongUsername'] =
                'Le champ "Utilisateur" doit faire moins de ' . $maxUsernameLength . ' caractères';
        }

        $maxPasswordLength = 255;
        if (strlen($data['password']) >= $maxPasswordLength) {
            $errors['toLongPassword'] =
                'Le champ "Mot de Passe" doit faire moins de ' . $maxPasswordLength . ' caractères';
        }

        return $errors;
    }
}
