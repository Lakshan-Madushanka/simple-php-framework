<?php

namespace App\Controller;

use App\Models\Post;
use Core\Controller;
use Core\View;


class Posts extends Controller
{
    public function indexAction()
    {

        print_r($this->queryParams);

        echo "This is index  </br>";

       $results = Post::getAllPosts();

        //print_r($results);

        View::renderTemplate('Home/index.html', [
            'name' => 'lakshan'
        ]);
    }
}