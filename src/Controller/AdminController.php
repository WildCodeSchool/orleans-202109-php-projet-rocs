<?php

namespace App\Controller;

use App\Model\AdminManager;

class AdminController extends AbstractController
{
    public function adminConnexion(): string
    {
        $adminManager = new AdminManager();
        $admins = $adminManager->selectAll();

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array_map('trim', $_POST);
            $errors = $this->validate($data);

            if (empty($errors)) {
                foreach ($admins as $admin) {
                    if (!($admin['password'] === $data['password']) && !($admin['username'] === $data['username'])) {
                        $errors['notFind'] = 'L\'utilisateur n\'a pas été trouver ou le mot de passe est éroné';
                    } else {
                        session_start();
                        $_SESSION['username'] = $data['username'];
                        header('Location: /admin/activites');
                    }
                }
            }
        }

        return $this->twig->render('admin/connexion.html.twig', ['admins' => $admins]);
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
