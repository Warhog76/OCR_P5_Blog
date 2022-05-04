<?php

namespace App\Utils;

Class Renderer
{

    public function render(string $path, array $variables=[]): void
    {

        extract($variables);

        ob_start();
        require('Templates/'.$path.'.html.php');
        $pageContent = ob_get_clean();

        require('Templates/layout.html.php');
    }


}


