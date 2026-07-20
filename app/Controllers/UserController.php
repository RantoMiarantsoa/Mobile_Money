<?php
namespace App\Controllers;
use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function index()
    {
        $userModel = new \App\Models\UserModel();
        $users = $userModel->findAll();
        return view('users/Index', ['users' => $users]);
    }

    public function create()
    {
        return view('users/Create');
    }

    public function store()
    {
        $userModel = new \App\Models\UserModel();

        $username  = trim((string) $this->request->getPost('username'));
        $plainPass = $this->request->getPost('password');
        

        // Validation minimale
        if (empty($username) || empty($plainPass)) {
            return redirect()->back()->with('error', 'Username et mot de passe requis');
        }

        // Hash du mot de passe avant insertion
        $hashedPassword = password_hash($plainPass, PASSWORD_BCRYPT);

        $userModel->insert([
            'username' => $username,
            'password' => $hashedPassword,
        ]);

        return redirect()->to('/login')->with('success', 'Compte créé avec succès. Vous pouvez maintenant vous connecter.');
    }

    public function login()
    {
        return view('users/Login');
    }

    public function authenticate()
    {
        $userModel = new \App\Models\UserModel();
        $username  = trim((string) $this->request->getPost('username'));
        $password  = (string) $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if (! $user || ! password_verify($password, $user['password'])) {
            return redirect()->to('/login')->with('error', 'Identifiants incorrects');
        }

        session()->set([
            'user_id' => $user['id'],
            'username' => $user['username'],
            'logged_in' => true,
        ]);

        return redirect()->to('/caisse');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}