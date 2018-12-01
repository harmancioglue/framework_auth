<?php

class Users extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {

    }

    public function register()
    {
        $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);


        /** check for post */
        if (GeneralUtils::isPostRequest()){
            /** process form */
            $data = [
               'name' => trim($_POST['name']),
               'email' => trim($_POST['email']),
               'password' => trim($_POST['password']),
               'confirm_password' => trim($_POST['confirm_password']),
                'error' => false,
            ];

            /** form validation */
            $data = $this->validation($data);
            if ($data['error']){
                $this->view('users/register',$data);
                exit;
            }

            $userModel = $this->userModel;

            /** check email exist */
            $isEmailExist = $userModel->findUserByEmail($data['email']);
            if ($isEmailExist){
                $data['email_error'] = "Email is already taken";
                $this->view('users/register',$data);
                exit;
            }

            /** hash password */
            $data['password'] = md5($data['password']);


            /** Register user */
            $registerResult = $this->userModel->registerUser($data);
            if ($registerResult){
                SessionUtils::createFlashMessage('register','You registered succesfully!');
                GeneralUtils::redirect('users/login');
                exit;
            }else{
                SessionUtils::createFlashMessage('register','Sorry.A problem ocurred. Try again!','warning');
                GeneralUtils::redirect('users/login');
                exit;
            }
        }

        /** load form */
        $data = [
          'name' => '',
          'email'=> '',
          'password' => '',
          'confirm_password' => '',
          'name_error' => '',
          'email_error' => '',
          'password_error' => '',
          'confirm_password_error' => '',
          'error' => false,
        ];

        $this->view('users/register',$data);
    }

    public function login()
    {
        $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

        /** check for post */
        if (GeneralUtils::isPostRequest()){
            /** process form */

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'error' => false
            ];

            $data = $this->validation($data);
            if ($data['error']){
                $this->view('users/login',$data);
                exit;
            }

            /** check user exist */
            $isEmailExist = $this->userModel->findUserByEmail($data['email']);
            if (!$isEmailExist){
                $data['email_error'] = "No user found";
                $this->view('users/login',$data);
                exit;
            }

            $loggedInUser = $this->userModel->login($data['email'],$data['password']);

            if ($loggedInUser != false){

                SessionUtils::setUser($loggedInUser);
                GeneralUtils::redirect('posts');
                exit;

            }else{
                SessionUtils::createFlashMessage('register','Sorry.A problem ocurred. Try again!','warning');
                GeneralUtils::redirect('users/login');
                exit;
            }

        }

        /** load form */
        $data = [
            'email'=> '',
            'password' => '',
            'email_error' => '',
            'password_error' => '',
        ];

        $this->view('users/login',$data);
    }

    public function logout(){
        SessionUtils::logoutUser();
        session_destroy();
        GeneralUtils::redirect('users/login');
        exit;
    }

    private function validation($data)
    {
        if (isset($data['email']) && empty($data['email'])){
            $data['email_error'] = 'Please enter email';
            $data['error'] = true;
        }

        if (isset($data['name']) && empty($data['name'])){
            $data['name_error'] = 'Please enter name';
            $data['error'] = true;
        }

        if (isset($data['password']) && empty($data['password'])){
            $data['password_error'] = 'Please enter password';
            $data['error'] = true;
        }elseif(isset($data['password']) && strlen($data['password']<6)){
            $data['password_error'] = 'Password must be at least 6 character';
            $data['error'] = true;
        }

        if (isset($data['confirm_password']) && empty($data['confirm_password'])){
            $data['confirm_password_error'] = 'Please confirm password';
            $data['error'] = true;
        }else{
            if ((isset($data['password']) && isset($data['confirm_password'])) &&  $data['password'] != $data['confirm_password']){
                $data['confirm_password_error'] = 'Passwords do not match';
                $data['error'] = true;
            }
        }

        return $data;

    }
}