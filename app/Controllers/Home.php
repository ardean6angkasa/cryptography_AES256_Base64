<?php

namespace App\Controllers;

use App\Models\Cryptograph;

class Home extends BaseController
{
    public function index()
    {
        $model = new Cryptograph();
        if (session()->get('type') == 'decryption') {
            $data = [
                'cryptool' => $model->getData()->getResult(),
                'validation' => \Config\Services::validation()
            ];
            echo view('/welcome_message', $data);
        } else {
            $data = [
                'cryptool' => $model->getData()->getResult(),
                'validation' => \Config\Services::validation()
            ];
            echo view('/welcome_message', $data);
        }
    }
    public function encrypt()
    {
        $rules = [
            'text' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'min_length' => 'At least 6 characters',
                    'required' => "Don't forget to fill this"
                ]
            ]
        ];
        if ($this->validate($rules)) {
            $model = new Cryptograph();
            $encrypter = \Config\Services::encrypter();
            $id = $this->request->getPost('id');
            $check = session()->get('type');
            if (empty($check)) {
                if (!empty($id)) {
                    $data = array(
                        'text' => base64_encode($encrypter->encrypt($this->request->getPost('text')))
                    );
                    $model->update($id, $data);
                    $new_data = [
                        'type' => 'decryption'
                    ];
                    session()->set($new_data);
                    session()->setFlashdata('msg', "Text is encrypted successfully");
                    return redirect()->to(base_url('/'));
                }
                $data = array(
                    'text' => base64_encode($encrypter->encrypt($this->request->getPost('text')))
                );
                $model->insert($data);
                $new_data = [
                    'type' => 'decryption'
                ];
                session()->set($new_data);
                session()->setFlashdata('msg', "Text is encrypted successfully");
                return redirect()->to(base_url('/'));
            } else {
                $data = array(
                    'text' => $encrypter->decrypt(base64_decode($this->request->getPost('text')))
                );
                $model->update($id, $data);
                $new_data = [
                    'type' => ''
                ];
                session()->set($new_data);
                session()->setFlashdata('msg', "Text is decrypted successfully");
                return redirect()->to(base_url('/'));
            }
        } else {
            $model = new Cryptograph();
            if (session()->get('type') == 'decryption') {
                $data = [
                    'cryptool' => $model->getData()->getResult(),
                    'validation' => \Config\Services::validation()
                ];
                echo view('/welcome_message', $data);
            } else {
                $data = [
                    'cryptool' => $model->getData()->getResult(),
                    'validation' => \Config\Services::validation()
                ];
                echo view('/welcome_message', $data);
            }
        }
    }

    public function create_key_AES265()
    {
        // fedfwefewfwefijijio
        // hit this to create a key for your AES encryption, copy your key and paste it in `app/Config/Encryption.php`
        $key = \CodeIgniter\Encryption\Encryption::createKey();
        echo $key;
    }
}