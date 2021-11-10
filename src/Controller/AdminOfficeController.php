<?php

namespace App\Controller;

use App\Model\OfficeManager;

class AdminOfficeController extends AbstractController
{
    public function index(): string
    {
        $officeManager = new OfficeManager();
        $offices = $officeManager->selectAll();

        return $this->twig->render('admin/adminOfficeOverview.html.twig', ['offices' => $offices]);
    }
}
