<?php


namespace App\Routers;

use App\Controllers\{Accounts,Articles,Comments,Contact,Renderer};
use App\Repositories\{Session};
use PHPMailer\PHPMailer\Exception;

class Routers
{

    public function __construct(
        private Accounts $accountController,
        private Articles $postController,
        private Comments $commentController,
        private Contact  $mailController,
        private Renderer $page,
        private Session $session,
    )
    {}

    /**
     * @throws Exception
     */
    public function get($get, $post): void
    {

        if ($get['page'] === 'home' || $get['page'] === null) :
            $this->postController->index();

        elseif ($get['page'] === 'blog') :
            $this->postController->showAll();

        elseif ($get['page'] === 'article') :
            $articleId = $get['id'];
            $comment = $name = $email = $submit = $csrf_token = null;

            if (isset($post['submit'])) {
                $comment = $post['comment'];
                $name = $post['name'];
                $email = $post['email'];
                $submit = $post['submit'];
                $csrf_token = $post['csrf_token'];
            }
            $this->postController->show($articleId);
            $this->commentController->addComments($comment,$name,$email,$submit,$csrf_token,$articleId);

        elseif ($get['page'] === 'contact') :
            $name = $email = $subject = $message = $csrf_token = $submit = null;

            if (isset($post['submit'])) {
                $name = $post['name'];
                $email = $post['email'];
                $subject = $post['subject'];
                $message = $post['message'];
                $submit = $post['submit'];
                $csrf_token = $post['csrf_token'];
            }

            $this->mailController->sendMail($name, $email, $subject, $message, $csrf_token, $submit);
            $this->page->render('contact');

        elseif ($get['page'] === 'register') :
            $username = $password = $passwordConfirm = $email = $csrf_token = $submit = null;

            if (isset($post['submit'])) {
                $username = $post['username'];
                $password = $post['password'];
                $passwordConfirm = $post['password_confirm'];
                $email = $post['email'];
                $submit = $post['submit'];
                $csrf_token = $post['csrf_token'];
            }

            $this->accountController->register($username, $password, $passwordConfirm, $email, $csrf_token, $submit);
            $this->page->renderLog('register');

        elseif ($get['page'] === 'confirm') :
            $userId = $get['id'];
            $token = $get['token'];
            $this->accountController->confirm($userId, $token);

        elseif ($get['page'] === 'login') :
            $password = $email = $submit = $csrf_token = null;

            if (isset($post['submit'])) {
                $password = $post['password'];
                $email = $post['email'];
                $submit = $post['submit'];
                $csrf_token = $post['csrf_token'];
            }
            $this->page->renderLog('login');
            $this->accountController->login($password, $email, $csrf_token, $submit);


        elseif ($get['page'] === 'account') :
            $password = $passwordConfirm = $submit = $csrf_token = null;

            if (isset($post['submit'])) {
                $password = $post['password'];
                $passwordConfirm = $post['password_confirm'];
                $submit = $post['submit'];
                $csrf_token = $post['csrf_token'];
            }
            $this->accountController->modPassword($password, $passwordConfirm, $csrf_token, $submit);
            $this->page->render('account');

        elseif ($get['page'] === 'remember') :
            $email = $submit = $csrf_token = null;

            if (isset($post['submit'])) {
                $email = $post['email'];
                $submit = $post['submit'];
                $csrf_token = $post['csrf_token'];
            }
            $this->accountController->remember($email, $csrf_token, $submit);
            $this->page->renderLog('remember');

        elseif ($get['page'] === 'reset') :

            $this->page->renderLog('reset');

            $userId = $get['id'];
            $token = $get['token'];
            $password = $passwordConfirm = null;
            if (isset($post['submit'])) {
                $password = $post['password'];
                $passwordConfirm = $post['password_confirm'];
            }

            $this->accountController->reset($userId, $token, $password, $passwordConfirm);

        elseif ($get['page'] === 'dashboard'):
            $this->commentController->findUnseen();

        elseif ($get['page'] === 'validate') :
            $commentId = $get['id'];
            $this->commentController->validateComment($commentId);

        elseif ($get['page'] === 'delete') :
            $commentId = $get['id'];
            $this->commentController->deleteComment($commentId);

        elseif ($get['page'] === 'list') :
            $this->postController->getAll();

        elseif ($get['page'] === 'post') :
            $id_post = $get['id'];
            $title = $chapo = $content = $submit = $writer = $posted = null;
            if (isset($post['submit'])) {
                $title = $post['title'];
                $chapo = $post['chapo'];
                $content = $post['content'];
                $writer = $post['writer'];
                $posted = $post['public'];
                $submit = $post['submit'];
            }

            $this->postController->modify($id_post, $submit, $title, $chapo, $content, $writer, $posted);

        elseif ($get['page'] === 'write') :
            $title = $chapo = $content = $submit = $public = null;
            if (isset($post['submit'])) {
                $title = $post['title'];
                $chapo = $post['chapo'];
                $content = $post['content'];
                $public = $post['public'];
                $submit = $post['submit'];
            }
            $this->postController->post($submit, $title, $chapo, $content, $public);
            $this->page->renderBack('write');

        elseif ($get['page'] === 'logout') :
            $this->session->logout();
            header('location: index.php?page=home');
        endif;
    }
}
