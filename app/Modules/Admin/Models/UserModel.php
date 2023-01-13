<?php

namespace App\Modules\Admin\Models;

class UserModel
{
    public function getUsers()
    {
        return [
            UserEntity::of('PL0001', 'Mufid Jamaluddin'),
            UserEntity::of('PL0002', 'Andre Jhonson'),
            UserEntity::of('PL0003', 'Indira Wright'),
        ];
    }

    public function check_login()
    {
        $username = session()->get('user')->username ?? false;
        if (isset($username) && is_string($username)) {
            return true;
        }
        return false;
    }

    public function login($username, $password)
    {
        $db = db_connect();

        $user = $db->table('st_table_users')->where(['username' => $username, 'password' => $password])->get()->getRow();
        $lastLogin = $db->table('st_table_users')->update(['last_login' => time()], ['id' => $user->id]);
        return $user ?? false;
    }

    public function newRecord($data)
    {
        $db = db_connect();
        $array = [
            'name' => $data['name'],
            'position' => $data['position'],
            'start_date' => $data['start_date'],
            'salary' => $data['salary'],
            'office' => $data['office'],
            'age' => $data['age'],
            'status' => '1',

        ];
        $result = $db->table('st_table_record')->insert($array);
        if ($result) {
            return session()->setFlashData('message', 'Insert successfull');
        } else {
            return session()->setFlashData('message', 'Insert failed');
        }
    }

    public function getRecord()
    {
        $db = db_connect();
        return $result = $db->table('st_table_record')->get()->getResult();
    }

    public function editRecord($id, $data = [])
    {
        $db = db_connect();
        if (empty($data)) {
            return $result = $db->table('st_table_record')->where('id', $id)->get()->getRow();
        }
        $array = [
            'name' => $data['name'],
            'position' => $data['position'],
            'start_date' => $data['start_date'],
            'salary' => $data['salary'],
            'office' => $data['office'],
            'age' => $data['age'],
            'status' => '1',

        ];
        $result = $db->table('st_table_record')->update($array, ['id' => $id]);
        if ($result) {
            session()->setFlashData('message', 'Update success');
        } else {
            session()->setFlashData('message', 'Update failed');
        }
    }

    public function deleteRecord($id)
    {
        $db = db_connect();

        $result = $db->table('st_table_record')->delete(['id' => $id]);
        if ($result) {
            session()->setFlashData('message', 'Delete success');
            return true;
        } else {
            session()->setFlashData('message', 'Delete failed');
            return false;
        }
    }
}
