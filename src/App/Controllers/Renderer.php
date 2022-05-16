<?php

namespace App\Controllers;

Class Renderer{

    public function render(string $path, array $variables=[]): void
    {

        extract($variables);

        ob_start();
        require('../src/App/Templates/'.$path.'.html.php');
        $pageContent = ob_get_clean();

        require('../src/App/Templates/layout.html.php');
    }

    public function renderBack(string $path, array $variables=[]): void
    {

        extract($variables);

        ob_start();
        require('../admin/Templates/'.$path.'.html.php');
        $pageContent = ob_get_clean();

        require('../admin/Templates/layout.html.php');
    }
}


