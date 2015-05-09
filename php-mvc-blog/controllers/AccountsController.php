<?php

class AccountsController extends BaseController {
    private $db;

    public function onInit() {
        $this->db = new AccountsModel();
        $this->title = "Account";
    }

    public function register() {
        if($this->isPost) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if($username == null || strlen($username) < 3){
                $this->addErrorMessage('Username is required and min length is 3 symbols');
                $this->redirect('accounts', 'register');
            }
            if($password == null || strlen($password) < 3){
                $this->addErrorMessage('Password is required and min length is 3 symbols');
                $this->redirect('accounts', 'register');
            }
            $email = $_POST['email'];
            $fullName = $_POST['fullName'];
            $isRegister = $this->db->register($username, $password, $email, $fullName);
            if($isRegister) {
                $_SESSION['username'] = $username;
                $this->addSuccessMessage("Successful register!");
                $this->redirect('questions');
            } else
            {
                $this->addErrorMessage("Register failed!");
            }
        }
        $this->renderView(__FUNCTION__);
    }

    public function login() {
        if($this->isPost) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if($username == null || strlen($username) < 3){
                $this->addErrorMessage('Username is required and min length is 3 symbols');
                $this->redirect('accounts', 'register');
            }
            if($password == null || strlen($password) < 3){
                $this->addErrorMessage('Password is required and min length is 3 symbols');
                $this->redirect('accounts', 'register');
            }
            $user = $this->db->login($username, $password);
            if($user) {
                $_SESSION['username'] = $username;
                if($user[0]['IsAdmin'] == 1) {
                    $_SESSION['isAdmin'] = true;
                }
                $this->addSuccessMessage("Successful Login!");
                $this->redirect('questions');
            } else {
                $this->addErrorMessage("Invalid Username or Password");
                $this->redirect('accounts', 'login');
            }
        }
        $this->renderView(__FUNCTION__);
    }

    public function logout() {
        $this->authorize();
        unset($_SESSION['username']);
        unset($_SESSION['isAdmin']);
        $this->addSuccessMessage("Successful logout!");
        $this->redirect('home');
    }

    public function edit() {
        $this->authorize();

        if($this->isPost) {
            if ($_POST['form'] == 'editProfile') {
                $username = $_SESSION['username'];
                $fullName = $_POST['fullName'];
                $email = $_POST['email'];

                $isChanged = $this->db->editProfile($username, $fullName, $email);
                if ($isChanged) {
                    $this->addSuccessMessage('Successful edit profile');
                } else {
                    $this->addErrorMessage("Editing a profile failed");
                }
            }

            if ($_POST['form'] == 'editPassword') {
                $username = $_SESSION['username'];
                $oldPassword = $_POST['password'];
                $newPassword = $_POST['newPassword'];
                $confirmPassword = $_POST['confirmPassword'];
                if($oldPassword == null || strlen($oldPassword) < 3 ||
                        $newPassword == null || strlen($newPassword) < 3 ||
                        $confirmPassword == null || strlen($confirmPassword) < 3 ||
                        $newPassword != $confirmPassword){
                    $this->addErrorMessage("Wrong data");
                    $this->redirect('accounts', 'edit');
                }

                $isChanged = $this->db->editPassword($username, $oldPassword, $newPassword);
                if ($isChanged) {
                    $this->addSuccessMessage('Successful edit password');
                    $this->redirect('accounts', 'edit');
                } else {
                    $this->addErrorMessage("Editing a password failed. Check your old password.");
                    $this->redirect('accounts', 'edit');
                }
            }
        }
            $this->userInfo = $this->db->getInfo($_SESSION['username']);
            $this->renderView(__FUNCTION__);
    }

    public function all($page = 1, $pageSize = 10) {
        $this->isAdmin();

        $this->page = $page;
        $this->pageSize = $pageSize;
        $page = $page-1;
        $all = $this->db->getMaxCount();
        $maxCount = $all[0]['maxCount'];
        $maxPage = floor($maxCount/$pageSize);
        if($maxCount%$pageSize>0){
            $maxPage++;
        }
        $from = $page * $pageSize;
        if($page > $maxPage){
            $page=$maxPage;
        }
        if($page < 0){
            $page = 0;
        }
        $this->maxPage=$maxPage;

        $this->users = $this->db->getAll($from, $pageSize);
        $this->renderView(__FUNCTION__);
    }

    public function adminEdit($id) {
        $this->isAdmin();

        if($this->isPost) {
            $username = $_POST['username'];
            $fullName = $_POST['fullName'];
            $email = $_POST['email'];
            $isAdmin = 0;
            if(isset($_POST['isAdmin'])){
                if($_POST['isAdmin'] == 1){
                    $isAdmin = 1;
                }
            }

            $isChanged = $this->db->editProfile($username, $fullName, $email, $isAdmin);
            if ($isChanged) {
                $this->addSuccessMessage('Successful edit profile');
                $this->redirect('accounts', 'all');
            } else {
                $this->addErrorMessage("Editing a profile failed");
            }

        }
        $this->userInfo = $this->db->getInfoById($id);
        $this->renderView(__FUNCTION__);
    }

    public function delete($id) {
        $this->isAdmin();

        $isDeleted = $this->db->delete($id);
        if($isDeleted){
            $this->addSuccessMessage('Successful deleted user');
        } else {
            $this->addErrorMessage('Deleted failed');
        }

        $this->redirect('accounts', 'all');
    }
}