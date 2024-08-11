<?php

namespace Controllers;

use Services\Controller;

class HomeController extends Controller
{   
    private $postsModel;

    public function __construct()
    {
        global $pdo;
    }

    public function index()
    {
        $this->render('index');
    }

    public function dashboard()
    {
        $this->render('dashboard');
    }

}