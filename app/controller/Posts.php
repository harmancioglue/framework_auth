<?php

class Posts extends Controller
{
    private $postModel;

    public function __construct()
    {
        if (!SessionUtils::isUserLogin()){
            GeneralUtils::redirect('users/login');
            exit;
        }

        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        /** get posts */
        $posts = $this->postModel->getPosts();

        $data = array(
            'posts' => $posts
        );
        $this->view('posts/index',$data);
    }

    public function add()
    {
        if (GeneralUtils::isPostRequest())
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => SessionUtils::getUser()->id,
                'title_error' => '',
                'body_error' => '',
                'error' => false
            ];

            $data = $this->validation($data);

            if ($data['error']){
                $this->view('posts/add',$data);
                exit;
            }

            $postAddResult = $this->postModel->addPost($data);

            if ($postAddResult){
                SessionUtils::createFlashMessage('post_added','Post Added');
            }
            else{
                SessionUtils::createFlashMessage('post_added','Sorry.There is a problem. Try again!','warning');
            }

            GeneralUtils::redirect('posts');
            exit;
        }

        $data = [
          'title' => '',
          'body' => ''
        ];

        $this->view('posts/add',$data);
        exit;
    }

    public function edit($id)
    {
        if (GeneralUtils::isPostRequest()){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => SessionUtils::getUser()->id,
                'title_error' => '',
                'body_error' => '',
                'error' => false
            ];

            $data = $this->validation($data);

            if ($data['error']){
                $this->view('posts/add',$data);
                exit;
            }

            $postUpdateResult = $this->postModel->updatePost($data);

            if ($postUpdateResult){
                SessionUtils::createFlashMessage('post_added','Post Updated');
            }
            else {
                SessionUtils::createFlashMessage('post_added','Sorry. Post could not updated. Try again!');
            }

            GeneralUtils::redirect('posts');
            exit;
        }

        $post = $this->postModel->getPost($id);

        if (!$post){
            GeneralUtils::redirect('posts');
            exit;
        }

        $user = SessionUtils::getUser();

        $post_user_id = $post->user_id;
        $user_id = $user->id;

        if ($post_user_id != $user_id){
            GeneralUtils::redirect('posts');
            exit;
        }

        $data = [
            'id' => $id,
            'title' => $post->title,
            'body' => $post->body
        ];

        $this->view('posts/edit',$data);
        exit;
    }

    public function show($id)
    {
        $post = $this->postModel->getPost($id);
        $user = SessionUtils::getUser();

        $data = array(
            'post' => $post,
            'user' => $user
        );

        $this->view('posts/show',$data);
    }

    public function delete($id){
        if (GeneralUtils::isPostRequest()){
            $post = $this->postModel->getPost($id);

            if (!$post){
                GeneralUtils::redirect('posts');
                exit;
            }

            $user = SessionUtils::getUser();

            $post_user_id = $post->user_id;
            $user_id = $user->id;

            if ($post_user_id != $user_id){
                GeneralUtils::redirect('posts');
                exit;
            }


            $deletePostResult = $this->postModel->deletePost($id);
            if ($deletePostResult){
                SessionUtils::createFlashMessage('post_added','Post Removed');
                GeneralUtils::redirect('posts');
                exit;
            }
        }

        GeneralUtils::redirect('posts');
        exit;
    }

    private function validation($data)
    {
        if (empty($data['title'])){
            $data['title_error'] = "Please enter title";
            $data['error']=true;
        }

        if (empty($data['body'])){
            $data['body_error'] = "Please enter body text";
            $data['error']=true;
        }

        return $data;

    }
}