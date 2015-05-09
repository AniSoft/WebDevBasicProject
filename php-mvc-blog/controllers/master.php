<?php

namespace Controllers;

class Master_Controller{
    protected $layout;
    protected $viewsDir;
    protected $message;
    protected $fieldsErrors;

    public function __construct(
        $className = '\Controllers\Master_Controller',
        $model = 'master',
        $viewsDir = '/views/master') {

        $this->viewsDir = $viewsDir;
        $this->className = $className;
        $this->message = NULL;
        $this->validator = new \Valitron\Validator($_POST);
        $this->fieldsErrors = array();

        // Names of fields for validation messages
        $this->validator->labels(array(
            'username' => 'Username',
            'firstName' => 'First name',
            'lastName' => 'Last name',
            'email' => 'Email address',
            'Password' => 'Password',
            'confirmPassword' => 'Confirm password'
        ));

        if ($model != NULL) {
            include_once ROOT_DIR . "/models/{$model}.php";
            $modelClass = "\Models\\" . ucfirst($model) . '_Model';
            $this->model = new $modelClass(
                array(
                    'table'=> 'none'
                )
            );
        }

        $this->auth = \Lib\Auth::get_instance();
        $loggedUser = $this->auth->getLoggedUser();
        $this->loggedUser = $loggedUser;
        $this->layout = ROOT_DIR . '/views/layouts/default.php';
    }

    function makeDateInFormat($dateStr) {
        $date = new \DateTime($dateStr);
        return $date->format('d M y');
    }

    public function redirectTo($path) {
        header("Location: " . $path);
        exit();
    }

    public function addMessage($text, $type) {

        //PHP > 5.4
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

//        //PHP < 5.4
//        if(session_id() == '') {
//            session_start();
//        }

        $_SESSION['message'] = array(
            'text' => $text,
            'type' => $type
        );

    }

    public function makeValidation($rules) {
        $this->validator->rules($rules);

        if($this->validator->validate()) {
            return $this->validator->data();
        } else {
            $allErrors = $this->validator->errors();
            $errors = array();

            foreach ($allErrors as $key => $error) {
                $errors[$key] = implode(', ', $error);
            }

            $this->fieldsErrors = $errors;
        }
    }
}

