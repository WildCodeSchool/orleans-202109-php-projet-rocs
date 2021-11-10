<?php

namespace App\Controller;

use App\Model\AdminManager;

class AdminController extends AbstractController
{
    public function adminConnexion(): string
    {
        $adminManager = new AdminManager();
        $admins = $adminManager->selectAll();

        return $this->twig->render('admin/connexion.html.twig', ['admins' => $admins]);
    }
}
