<?php

namespace App\Controllers;

Class Renderer{

    public function render(string $path, array $variables=[]): void
    {

        extract($variables);

        ob_start();
        require('../src/App/Templates/Public/'.$path.'.html.php');
        $pageContent = ob_get_clean();

        require('../src/App/Templates/Public/layout.html.php');
    }

    public function renderLog(string $path, array $variables=[]): void
    {

        extract($variables);

        ob_start();
        require('../src/App/Templates/Public/'.$path.'.html.php');
        $pageContent = ob_get_clean();

        require('../src/App/Templates/Public/layoutLog.html.php');
    }

    public function renderBack(string $path, array $variables=[]): void
    {

        extract($variables);

        ob_start();
        require('../src/App/Templates/Admin/'.$path.'.html.php');
        $pageContent = ob_get_clean();

        require('../src/App/Templates/Admin/layoutBack.html.php');
    }
}


