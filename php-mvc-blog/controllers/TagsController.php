<?php

class TagsController extends BaseController {
    private $db;

    public function onInit()
    {
        $this->db = new TagsModel();
        $this->title = "Tags";
    }

    public function index($page = 1, $pageSize = 5) {
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

        $this->tags = $this->db->getAllWithPage($from, $pageSize);
        $this->renderView();
    }

    public function edit($id) {
        $this->isAdmin();

        if($this->isPost){
            $title = $_POST['title'];
            $isChange = $this->db->edit($id, $title);
            if($isChange){
                $this->addSuccessMessage("Successful editing tags with Id - $id");
                $this->redirect('tags');
            } else {
                $this->addErrorMessage("Editing failed");
            }

        } else {
            $this->tagsInfo = $this->db->getInfo($id);
            $this->renderView(__FUNCTION__);
        }
    }

    public function add() {
        $this->isAdmin();

        if($this->isPost){
            $title = $_POST['title'];
            $isChange = $this->db->add($title);
            if($isChange){
                $this->addSuccessMessage("Successful adding tags");
                $this->redirect('tags');
            } else {
                $this->addErrorMessage("Adding failed");
            }

        }
        $this->renderView(__FUNCTION__);
    }

    public function delete($id) {
        $this->isAdmin();
        
        if($this->isPost){
            $isChange = $this->db->delete($id);
            if($isChange){
                $this->addSuccessMessage("Successful adding tags");
                $this->redirect('tags');
            } else {
                $this->addErrorMessage("Adding failed");
            }

        } else {
            $this->tagsInfo = $this->db->getInfo($id);
            $this->renderView(__FUNCTION__);
        }
    }
}