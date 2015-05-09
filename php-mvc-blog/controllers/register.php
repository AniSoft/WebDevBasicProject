<?php
namespace Controllers;

class Register_Controller extends Master_Controller{
    public function __construct() {
        parent::__construct(get_class(), 'register', '/views/register/');
        $this->fieldsErrors = array();
    }

    function index() {
        $template = ROOT_DIR . $this->viewsDir . 'index.php';
        if (isset($_POST['submitted']) && $_POST['submitted'] = 1) {
            $userData = $this->getFormData();
            $result = $this->model->registerUser($userData);
            if ($result) {
                $this->addMessage('You are registered now! If you want login now!', 'info');
                $this->redirectTo('/login/index');
            } else {
                $this->addMessage('You ar not registered! Please try again later!', 'error');
            }
        }

        include_once $this->layout;
    }

    private function getFormData() {
        $rules = [
            'required' => [
                ['username'],
                ['firstName'],
                ['lastName'],
                ['email'],
                ['password'],
                ['confirmPassword']
            ],
            'lengthMin' => [
                ['username', 5],
                ['firstName', 3],
                ['lastName', 3],
                ['password', 5]
            ],
            'lengthMax' => [
                ['username', 20],
                ['firstName', 20],
                ['lastName', 20],
                ['password', 10]
            ],
            'alpha' => [
                ['firstName'],
                ['lastName'],
            ],
            'slug' => [
                ['userName'],
                ['password']
            ],
            'email' => [
                ['email']
            ],
            'equals' => [
                ['password', 'confirmPassword']
            ]
        ];

        return $this->makeValidation($rules);
    }
}
