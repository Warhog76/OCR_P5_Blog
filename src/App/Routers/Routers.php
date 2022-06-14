<?php


namespace App\Routers;

use App\Controllers\{Accounts,Articles,Comments,Contact,Renderer};
use App\Repositories\{Session,ArticleRepo};
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
        private ArticleRepo $post,
    )
    {}

    /**
     * @throws Exception
     */
    public function get($get, $post, $files): void
    {

        if ($get['page'] === 'home' || $get['page'] === null) :
            $this->postController->index();

        elseif ($get['page'] === 'blog') :
            $this->postController->showAll();

        elseif ($get['page'] === 'article') :
            $articleId = $get['id'];
            $comment = $name = $email = $submit = null;
            if (isset($post['submit'])) {
                $comment = $post['comment'];
                $name = $post['name'];
                $email = $post['email'];
                $submit = $post['submit'];
            }
            $this->postController->show($articleId);
            $this->commentController->addComments($comment,$name,$email,$submit,$articleId);

        elseif ($get['page'] === 'contact') :
            $name = $email = $subject = $message = $submit = null;
            if (isset($post['submit'])) {
                $name = $post['name'];
                $email = $post['email'];
                $subject = $post['subject'];
                $message = $post['message'];
                $submit = $post['submit'];
            }
            $this->mailController->sendMail($name, $email, $subject, $message, $submit);
            $this->page->render('contact');

        elseif ($get['page'] === 'confirm') :
            $userId = $get['id'];
            $token = $get['token'];
            $this->accountController->confirm($userId, $token);

        elseif ($get['page'] === 'remember') :
            $email = $submit = null;
            if (isset($post['submit'])) {
                $email = $post['email'];
                $submit = $post['submit'];
            }
            $this->accountController->remember($email, $submit);
            $this->page->renderLog('remember');

        elseif ($get['page'] === 'register') :
            $username = $password = $passwordConfirm = $email = $submit = null;
            if (isset($post['submit'])) {
                $username = $post['username'];
                $password = $post['password'];
                $passwordConfirm = $post['password_confirm'];
                $email = $post['email'];
                $submit = $post['submit'];
            }
            $this->accountController->register($username, $password, $passwordConfirm, $email, $submit);
            $this->page->renderLog('register');

        elseif ($get['page'] === 'login') :
            $password = $email = $submit = null;
            if (isset($post['submit'])) {
                $password = $post['password'];
                $email = $post['email'];
                $submit = $post['submit'];
            }

            $this->accountController->login($password, $email, $submit);
            $this->page->renderLog('login');

        elseif ($get['page'] === 'account') :
            $password = $passwordConfirm = $submit = null;
            if (isset($post['submit'])) {
                $password = $post['password'];
                $passwordConfirm = $post['password_confirm'];
                $submit = $post['submit'];
            }
            $this->accountController->modPassword($password, $passwordConfirm, $submit);
            $this->page->render('account');

        elseif ($get['page'] === 'reset') :
            $userId = $get['id'];
            $token = $get['token'];
            $password = $passwordConfirm = null;
            if (isset($post['submit'])) {
                $password = $post['password'];
                $passwordConfirm = $post['password_confirm'];
            }
            $this->accountController->reset($userId, $token, $password, $passwordConfirm);
            $this->page->renderLog('reset');

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
            $id = $get['id'];
            $title = $chapo = $content = $submit = $posted = null;
            if (isset($post['submit'])) {
                $title = $post['title'];
                $chapo = $post['chapo'];
                $content = $post['content'];
                $posted = $post['public'];
                $submit = $post['submit'];
            }

            $this->postController->modify($id, $submit, $title, $chapo, $content, $posted);


        elseif ($get['page'] === 'write') :
            $title = $chapo = $content = $submit = $files = $public = null;
            if (isset($post['submit'])) {
                $title = $post['title'];
                $chapo = $post['chapo'];
                $content = $post['content'];
                $public = $post['public'];
                $submit = $post['submit'];
            }
            $this->postController->post($submit, $title, $chapo, $content, $public,$files);
            $this->page->renderBack('write');

        elseif ($get['page'] === 'logout') :
            $this->session->logout();
            header('location: index.php?page=home');
        endif;
    }
}
