<?php

namespace App\Controller;

use App\Model\OfficeManager;
use Error;

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
        $errors = $office = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $office = array_map('trim', $_POST);
            $errors = $this->officeValidate($office);
            if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                $maxfileSize = '1300000';
                if ($_FILES['image']['size'] > $maxfileSize) {
                    $errors[] = 'le fichier doit faire moin de' . $maxfileSize / 1000000 . 'M';
                }
                $authorizeTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                $fileType = mime_content_type($_FILES['image']['tmp_name']);
                if (!in_array($fileType, $authorizeTypes)) {
                    $errors[] = 'le type mine doit être parmi' . implode(', ', $authorizeTypes);
                }
            } else {
                $errors[] = 'Erreur d\'upload';
            }
            if (empty($errors)) {
                $fileName = uniqid() . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $fileName);
                $office['image'] = $fileName;
                $officeManager = new OfficeManager();
                $officeManager->insert($office);
                header('Location:/admin/office');
            }
        }
        return $this->twig->render('admin/adminOfficeAdd.html.twig', ['errors' => $errors, 'office' => $office]);
    }
    /**
     * Edit a spersonnel office
     */
    public function edit(int $id): string
    {
        $errors = $office = [];
        $officeManager = new OfficeManager();
        $office = $officeManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $office = array_map('trim', $_POST);
            $office['id'] = $id;
            $errors = $this->officeValidate($office);
            if (empty($errors)) {
                $officeManager->update($office);
                header('Location: /admin/office');
            }
        }
        return $this->twig->render('admin/adminOfficeEdit.html.twig', ['errors' => $errors, 'office' => $office]);
    }
    /**
     * Delete a spersonnel office
     */
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $officeManager = new OfficeManager();
            $office = $officeManager->selectOneById((int)$id);
            if (file_exists('uploads/' . $office['image'])) {
                unlink('uploads/' . $office['image']);
            }
            $officeManager->delete((int)$id);
            header('Location: /admin/office');
        }
    }

    private function officeValidate(array $office): array
    {
        $errors = [];

        if (empty($office['role'])) {
            $errors[] = 'Le champ rôle est obligatoire';
        }
        $maxRoleLength = 50;
        if (strlen($office['role']) > $maxRoleLength) {
            $errors[] = 'Le champ rôle doit faire moins de ' . $maxRoleLength . 'caractères';
        }
        if (empty($office['lastname'])) {
            $errors[] = 'Le champ nom est obligatoire';
        }
        $maxLastnameLength = 60;
        if (strlen($office['lastname']) > $maxLastnameLength) {
            $errors[] = 'Le champ nom doit faire moins de ' . $maxLastnameLength . 'caractères';
        }
        if (empty($office['firstname'])) {
            $errors[] = 'Le champ prénom est obligatoire';
        }
        $maxFirstnameLength = 60;
        if (strlen($office['firstname']) > $maxFirstnameLength) {
            $errors[] = 'Le champ prénom doit faire moins de ' . $maxFirstnameLength . 'caractères';
        }
        return $errors;
    }
}
