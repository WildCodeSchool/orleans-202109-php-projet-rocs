<?php

namespace App\Controller;

use App\Model\OfficeManager;

class AdminOfficeController extends AbstractController
{
    public function index(): string
    {
        $officeManager = new OfficeManager();
        $offices = $officeManager->adminSelectAll();
        return $this->twig->render('admin/adminOfficeOverview.html.twig', ['offices' => $offices]);
    }
    /**
     * Add a new personnel
     */
    public function add(): string
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $office = array_map('trim', $_POST);

            // TODO validations (length, format...)
            if (empty($office['role'])) {
                $errors[] = 'Le champ role est obligatoire';
            }
            $maxRoleLength = 50;
            if (strlen($office['role']) > $maxRoleLength) {
                $errors[] = 'Le champ role doit faire moins de ' . $maxRoleLength;
            }
            if (empty($office['lastname'])) {
                $errors[] = 'Le champ nom est obligatoire';
            }
            $maxLastnameLength = 60;
            if (strlen($office['lastname']) > $maxLastnameLength) {
                $errors[] = 'Le champ nom doit faire moins de ' . $maxLastnameLength;
            }
            if (empty($office['firstname'])) {
                $errors[] = 'Le champ prénom est obligatoire';
            }
            $maxFirstnameLength = 60;
            if (strlen($office['firstname']) > $maxFirstnameLength) {
                $errors[] = 'Le champ prénom doit faire moins de ' . $maxFirstnameLength;
            }
            if (empty($errors)) {
                $officeManager = new OfficeManager();
                $officeManager->insert($office);
                header('Location:/admin/office/ajout');
            }
        }
        return $this->twig->render('admin/adminOfficeAdd.html.twig', ['errors' => $errors]);
    }
}
