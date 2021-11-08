<?php

namespace App\Controller;

class MembershipController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Membership/index.html.twig');
    }
}
