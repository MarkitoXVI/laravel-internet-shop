<?php

namespace Controllers;

class HomeController
{
    public function index()
    {
        view('home/index', [
            'page_title' => 'Home Page',
        ]);
    }
}