<?php

namespace App\Controller;

use App\Model\AdminManager;

class AdminController extends AbstractController
{
    public function adminConnection(): string
    {
        $adminManager = new AdminManager();
        $errors = [];
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array_map('trim', $_POST);
            $errors = $this->validate($data);
            if (empty($errors)) {
                $admin = $adminManager->selectOneAdmin($data['username']);
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
                'data' => $data
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
        return $this->twig->render('admin/adminError.html.twig');
    }

    public function view(): string
    {
        if (!isset($_SESSION['username'])) {
            header('Location: /admin/erreur');
        }
        $adminManager = new AdminManager();
        $admins = $adminManager->selectAllAdmin();

        return $this->twig->render('admin/adminAdminsOverview.html.twig', ['admins' => $admins]);
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
