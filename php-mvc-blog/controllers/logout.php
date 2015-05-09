<?php
namespace Controllers;
class Logout_Controller extends Master_Controller {
    public function __construct() {
        parent::__construct(get_class(), NULL, NULL);
    }

    public function index() {
        session_destroy();
        $this->message['type'] = 'info';
        $this->message['text'] = 'You are out of the system now ;)';

        header("Location: " . '/');
        exit();
    }
}
