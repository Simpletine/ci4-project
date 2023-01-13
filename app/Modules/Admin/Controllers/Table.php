<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\UserModel;
use CodeIgniter\Controller;

class Table extends Controller
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


    public function table($action = false, $id = 0)
    {
        if (!$this->userModel->check_login()) {
            return redirect()->to('/admin/login');
        }
        $data = [
            'username' => $this->session->get('user')->username,
            'action' => $action,
            'id' => $id,
        ];
        echo view('admin/render/header', $data);
        echo view('admin/render/sidebar', $data);

        switch ($action) {
            case 'new':
                if ($post = $this->request->getPost()) {
                    $result = $this->userModel->newRecord($post);
                }
                $data['message'] = $this->session->getFlashData('message');
                echo view('admin/tables-new', $data);
                break;
            case 'edit':
                if ($record = $this->userModel->editRecord($id)) {
                    $data['edit'] = $record;
                }

                if ($record && $post = $this->request->getPost()) {
                    $this->userModel->editRecord($id, $post);
                }
                $data['message'] = $this->session->getFlashData('message');
                echo view('admin/tables-new', $data);
                break;
            case 'delete':
                if ($record = $this->userModel->editRecord($id)) {
                    $data['edit'] = $record;
                }
                if ($record && $post = $this->request->getPost() && $result = $this->userModel->deleteRecord($id)) {
                    return redirect()->to('/admin/table');
                } else {

                    $data['message'] = $this->session->getFlashData('message');
                    echo view('admin/tables-new', $data);
                }
                break;
            default:
                $data['message'] = $this->session->getFlashData('message');
                $data['record'] = $this->userModel->getRecord();
                echo view('admin/tables', $data);
                break;
        }
        echo view('admin/render/footer', $data);
    }
}
