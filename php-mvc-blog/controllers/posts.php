<?php

namespace Controllers;

class Posts_Controller extends Master_Controller {
    public function __construct() {
        parent::__construct(get_class(), 'post', '/views/posts/');
    }

    public function index($days = NULL) {
        $tagName = NULL;
        if (isset($_POST['searched']) && $_POST['searched'] == 1) {
            if (isset($_POST['tagName'])) {
                $tagName = $_POST['tagName'];
            }
        }

        $template = ROOT_DIR . $this->viewsDir . 'index.php';

        $postsResult = $this->model->getAllPosts($tagName, $days);

        $posts = array();
        foreach ($postsResult as $post) {
            $post['tags'] = $this->model->getTagsForPost($post['id']);
            $posts[] = $post;
        }

        $mostPopularTags = $this->model->getThenMostPopularTags();
        include_once $this->layout;
    }

    public function add() {
        if (!$this->auth->isLogged()) {
            $this->redirectTo('/login/index');
        }

        $template = ROOT_DIR . $this->viewsDir . 'add.php';
        if (isset($_POST['submitted']) && $_POST['submitted'] == 1 ) {
            $isAdded = FALSE;
            $validData = $this->getAddPostFormData();

            if ($validData != NULL) {
                $postData = $this->preparePostData($validData);
                $postData['user_id'] = $this->auth->getLoggedUser()['id'];
                $postData['visits'] = 0;
                $postData['date'] = date('Y-m-d H:m:s', time());
                $isAdded = $this->model->addPost($postData);
                if ($isAdded) {
                    $this->addMessage('Your post in the system now ;)', 'info');
                    $this->redirectTo('/posts/index');
                }

                $this->addMessage('Post is not recorded in database! Please try again later!', 'error');
            }
//            else {
//                $this->addMessage('All fields are mandatory!', 'error');
//            }
        }

        include_once $this->layout;
    }

    public function view($id) {
        if (!is_numeric($id)) {
            $this->addMessage('Invalid URL', 'error');
            $this->redirectTo('/posts/index');
        }

        $this->model->updateCounter($id);

        $template = ROOT_DIR . $this->viewsDir . 'view.php';

        if (isset($_POST['submitted']) && $_POST['submitted'] == 1) {
            $commentData = $this->getAddCommentFormData();

            if ($commentData != NULL) {
                $commentData['post_id'] = $id;
                $commentData['date'] = date('Y-m-d H:m:s', time());
                $isAdded = $this->model->insertComment($commentData);
                if ($isAdded) {
                    $this->addMessage('Your comment in the system now ;)', 'info');
                    $this->redirectTo("/posts/view/$id");
                } else {
                    $this->addMessage('Post is not recorded in database! Please try again later!', 'error');
                }
            }
        }

        $post = $this->model->getPostById($id)[0];
        $comments = $this->model->getAllCommentsForPost($id);
        include_once $this->layout;
    }

    public function byPeriod($days) {
        if (!is_numeric($days)) {
            $this->addMessage('Invalid URL', 'error');
            $this->redirectTo('/posts/index');
        }

        $date = date_create(date(''));
        date_sub($date, date_interval_create_from_date_string("$days days"));
        $dateAsString = date_format($date, 'Y-m-d H:i:s');
        $this->index($dateAsString);
    }

    private function preparePostData($validData) {
        $data = array();
        $data['title'] = trim($validData['title']);
        $data['text'] = trim($validData['text']);
        $tags = array();
        foreach ($validData as $key => $value) {
            if (strpos($key,'tag') !== FALSE && !empty($value)) {
                $tags[] = mysql_real_escape_string(trim($value));
            }
        }

        $data['tags'] = $tags;
        return $data;
    }

    private function getAddCommentFormData() {
        $rules = [
            'required' => [
                ['author'],
                ['text']
            ],
            'lengthMin' => [
                ['author', 5],
                ['text', 5]
            ],
            'lengthMax' => [
                ['author', 20],
                ['text', 500]
            ],
            'slug' => [
                ['author']
            ],
            'email' => [
                ['email']
            ]
        ];

        return $this->makeValidation($rules);
    }

    private function getAddPostFormData() {
        $rules = [
            'required' => [
                ['title'],
                ['text'],
                ['tag1']
            ],
            'lengthMin' => [
                ['title', 5],
                ['text', 5],
                ['tag1', 3],
                ['tag2', 3],
                ['tag3', 3],
                ['tag4', 3],
                ['tag5', 3]
            ],
            'lengthMax' => [
                ['title', 200],
                ['text', 1000],
                ['tag1', 20],
                ['tag2', 20],
                ['tag3', 20],
                ['tag4', 20],
                ['tag5', 20]
            ],
            'slug' => [
                ['tag1'],
                ['tag2'],
                ['tag3'],
                ['tag4'],
                ['tag5']
            ]
        ];

        return $this->makeValidation($rules);
    }
}

