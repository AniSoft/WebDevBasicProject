<?php
class QuestionsController extends BaseController{
    private $db;
    private $dbCategories;
    public function onInit(){
        $this->title = "Questions";
        $this->db = new QuestionsModel();
        $this->dbCategories = new CategoriesModel();
    }

    public function index($page = 1, $pageSize = 5, $category = '') {
        $this->page = $page;
        $this->pageSize = $pageSize;
        $this->setCategory = $category;
        $page = $page-1;
        $category = '%' . urldecode($category) . '%';
        $all = $this->db->getMaxCount($category);
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

        $this->categories = $this->dbCategories->getAll();

        $this->questions = $this->db->getAllWithPageAndCategory($from, $pageSize, $category);
        $this->renderView();
    }

    public function view($questionId, $page = 1, $pageSize = 5) {
        $this->page = $page;
        $this->pageSize = $pageSize;
        $this->questionId = $questionId;
        $page = $page-1;
        $all = $this->db->getMaxCountAnswer($questionId);
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


        $this->questionWithAnswers = $this->db->getByIdWithAnswer($questionId, $from, $pageSize);
        $this->renderView(__FUNCTION__);
    }

    public function add() {
        $this->authorize();

        if($this->isPost) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $categoryId = $_POST['selectCategory'];
            $tags = $_POST['check_tags'];

            $questionId = $this->db->add($title, $content, $categoryId, $tags);

            if($questionId){
                $this->addSuccessMessage("Added successful question");
                $this->redirectToUrl("/questions/view/$questionId");
            }

        } else {
            $this->TagsAndCategories = $this->db->getAllTagsAndCategories();
            $this->renderView(__FUNCTION__);
        }
    }

    public function edit($id) {
        $this->isAdmin();

        if($this->isPost){
            $title = $_POST['title'];
            $content = $_POST['content'];
            $categoryId = $_POST['selectCategory'];
            $tags = $_POST['check_tags'];

            $isChange = $questionId = $this->db->edit($id, $title, $content, $categoryId, $tags);
            if($isChange){
                $this->addSuccessMessage("Editing successful question");
                $this->redirectToUrl("/questions/view/$id");
            } else{
                $this->addErrorMessage('Editing failed');
                $this->renderView(__FUNCTION__);
            }
        } else {
            $this->TagsAndCategories = $this->db->getAllTagsAndCategories();
            $this->questionInfo = $this->db->getInfo($id);
            $this->renderView(__FUNCTION__);
        }
    }

    public function delete($id) {
        $this->isAdmin();

        $isDeleted = $this->db->delete($id);
        if($isDeleted){
            $this->addSuccessMessage('Successful deleted');
            $this->redirect('questions');
        } else{
            $this->addErrorMessage('Delete failed');
            $this->redirectToUrl("/questions/view/$id");
        }
    }

    public function search() {
        if($this->isPost){
            $searchWord = $_POST['searchWord'];
            $searchWord = '%' . $searchWord . '%';
            $this->searchByQuestion = $this->db->searchByQuestion($searchWord);

            $this->searchByAnswer= $this->db->searchByAnswer($searchWord);
            $this->searchByTag = $this->db->searchByTag($searchWord);
        }

        $this->renderView(__FUNCTION__);
    }

    public function ranking() {
        $this->ranking = $this->db->ranking();
        $this->renderView(__FUNCTION__);
    }
}