<?php

namespace App\Controller;

use App\Model\OfficeManager;

class OfficeController extends AbstractController
{
    public function index()
    {
        $officeManager = new OfficeManager();
        $offices = $officeManager->selectAll();
        return $this->twig->render('Office/office.html.twig', ['offices' => $offices]);
    }
}
