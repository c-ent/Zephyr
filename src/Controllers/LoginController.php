<?php
namespace Controllers;
use Services\Controller;
use App\Models\Users;

class LoginController extends Controller

{
    private $userModel;

    public function __construct()
    {   
        global $pdo;
        $this->userModel = new Users($pdo);
    }


    public function showLoginForm()
    {
        $this->render('login');
    }


    public function processLogin()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($this->login($username, $password)) {
            header('Location: /dashboard');
            exit();
        } else {
            $this->render('login', ['error' => 'Invalid username or password.']);
        }
    }


    private function login($username, $password)
    {
        $user = $this->userModel->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return true;
        }

        return false;
    }

    public function logout()
    {

        session_destroy();
        header('Location: /login');
        exit();
    }
}
