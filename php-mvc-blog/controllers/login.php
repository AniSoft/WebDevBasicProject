<?php

namespace Controllers;

class Login_Controller extends Master_Controller {
    public function __construct() {
        //className, modelName, viewsDirectory
        parent::__construct(get_class(), 'login', '/views/login/');
    }

    function index() {
        if (isset($_POST['submitted'])) {
            $data = $this->getDataFromForm();
            if ($data != NULL) {
                $isLogged = $this->auth->logIn($data['username'], $data['password']);
            }

            if (isset($isLogged) && $isLogged == TRUE) {
                $this->addMessage('You are in the system now ;)', 'info');
                $this->redirectTo('/posts/index');
            } else {
                $this->addMessage('Your login data is invalid!', 'error');
            }
        }

        $template = ROOT_DIR . $this->viewsDir . 'index.php';
        include_once $this->layout;
    }

    private function getDataFromForm() {
        $rules = [
            'required' => [
                ['username'],
                ['password']
            ],
            'lengthMin' => [
                ['username', 3],
                ['password', 3]
            ],
            'lengthMax' => [
                ['username', 20],
                ['password', 10]
            ],
            'slug' => [
                ['userName'],
                ['password']
            ]
        ];

        return $this->makeValidation($rules);
    }
}
