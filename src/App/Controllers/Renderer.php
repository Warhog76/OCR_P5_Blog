<?php

namespace App\Controllers;

use App\Repositories\Session;

Class Renderer
{
    public function __construct(private Session $session)
    {
    }

    public function render(string $path, array $variables=[]): void
    {
        $session = $this->session;
        extract($variables);

        ob_start();
        require('../src/App/Templates/Public/'.$path.'.html.php');
        $pageContent = ob_get_clean();

        require('../src/App/Templates/Public/layout.html.php');
    }

    public function renderLog(string $path, array $variables=[]): void
    {

        $session = $this->session;
        extract($variables);

        ob_start();
        require('../src/App/Templates/Public/'.$path.'.html.php');
        $pageContent = ob_get_clean();

        require('../src/App/Templates/Public/layoutLog.html.php');
    }

    public function renderBack(string $path, array $variables=[]): void
    {

        $session = $this->session;
        extract($variables);

        ob_start();
        require('../src/App/Templates/Admin/'.$path.'.html.php');
        $pageContent = ob_get_clean();

        require('../src/App/Templates/Admin/layoutBack.html.php');
    }
}


