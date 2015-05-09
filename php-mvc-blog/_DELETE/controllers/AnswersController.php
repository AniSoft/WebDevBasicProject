<?php
/**
 * Created by PhpStorm.
 * User: Vesko
 * Date: 30/04/2015
 * Time: 13:44
 */

class AnswersController extends BaseController {
    private $db;
    public function onInit(){
        $this->title = "Answer";
        $this->db = new AnswersModel();
    }

    public function add($questionId) {
        $this->questionId = $questionId;
        if($this->isPost){
            $content = $_POST['content'];
            $authorName = $_POST['authorName'];
            $authorEmail = $_POST['authorEmail'];
            if($content == null || strlen($content) < 3){
                $this->addErrorMessage('Content is required and min length is 3 symbols');
                $this->redirectToUrl("/answers/add/$questionId");
            }
            if($authorName == null || strlen($authorName) < 3){
                $this->addErrorMessage('Author Name is required and min length is 3 symbols');
                $this->redirectToUrl("/answers/add/$questionId");
            }

            $isAdd = $this->db->add($questionId, $content, $authorName, $authorEmail);
            if($isAdd){
                $this->addSuccessMessage("Successful added answer!");
                $this->redirectToUrl("/questions/view/$questionId");
            } else {
                $this->addErrorMessage("Added failed!");
            }
        }
        $this->renderView(__FUNCTION__);
    }

    public function edit($answerId, $questionId) {
        $this->isAdmin();

        if($this->isPost){
            $content = $_POST['content'];
            $authorName = $_POST['authorName'];
            $authorEmail = $_POST['authorEmail'];

            $isChange = $this->db->edit($answerId, $content, $authorName, $authorEmail);
            if($isChange){
                $this->addSuccessMessage("Editing successful answer");
                $this->redirectToUrl("/questions/view/$questionId");
            } else{
                $this->addErrorMessage('Editing failed');
                $this->renderView(__FUNCTION__);
            }
        } else {
            $this->answer = $this->db->getInfo($answerId);
            $this->questionId = $questionId;
            $this->renderView(__FUNCTION__);
        }
    }

    public function delete($answerId, $questionId) {
        $this->isAdmin();

        $isDeleted = $this->db->delete($answerId);
        if($isDeleted){
            $this->addSuccessMessage('Successful deleted');
            $this->redirectToUrl("/questions/view/$questionId");
        } else{
            $this->addErrorMessage('Delete failed');
            $this->redirectToUrl("/questions/view/$questionId");
        }
    }
}