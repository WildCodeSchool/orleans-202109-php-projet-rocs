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
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array_map('trim', $_POST);
            $errors = $this->validate($data);
            if (empty($errors)) {
                foreach ($admins as $admin) {
                    if (
                        password_verify($data['password'], $admin['password'])
                        && $admin['username'] == $data['username']
                    ) {
                        $_SESSION['username'] = $data['username'];
                        header('Location: /admin/activites');
                    } else {
                        $errors['notFind'] = 'L\'utilisateur n\'a pas été trouver ou le mot de passe est éroné';
                    }
                }
            }
        }

        return $this->twig->render(
            'admin/connexion.html.twig',
            [
                'admins' => $admins,
                'errors' => $errors,
                'data' => $data
            ]
        );
    }

    public function adminDeconnection()
    {

        //Desctruction des cookies de session
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();
        header('Location: /admin/connection');
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
