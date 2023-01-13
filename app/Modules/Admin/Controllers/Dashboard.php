<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\UserModel;
use CodeIgniter\Controller;

class Dashboard extends Controller
{
    private $userModel;
    protected $session;
    protected $request;

    /**
     * Constructor.
     */
    public function __construct()
    {
        helper(['form', 'url']);
        $this->userModel = new UserModel();
        $this->session = session();
        $this->request =  \Config\Services::Request();
   
    }

    public function index()
    {
        if (!$this->userModel->check_login()) {
            return self::login();
        }
        $data = [
            'username' => $this->session->get('user')->username,
        ];
        echo view('admin/render/header', $data);
        echo view('admin/render/sidebar', $data);
        echo view('admin/index', $data);
        echo view('admin/render/footer', $data);
    }

    public function login()
    {
        if ($this->request->getPost()) {
            if ($user = $this->userModel->login($username = $this->request->getPost('username'), $password = $this->request->getPost('password'))) {
                $this->session->set('user', $user);
                $this->session->setFlashData('message', 'Welcome back');
                return redirect()->to('/admin/dashboard')->withCookies();
            } else {
                $this->session->setFlashData('message', 'Login Failed');
            }
        }
        $data['message'] = $this->session->getFlashData('message');
        $data['username'] = form_input('username', $username ?? '', 'class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Username..."');
        $data['password'] = form_input('password', $password ?? '', 'class="form-control form-control-user" id="exampleInputPassword" placeholder="Password"', 'password');
        return view('admin/login', $data);
    }

    public function logout()
    {
        session_destroy();
        return self::login();
    }
}
