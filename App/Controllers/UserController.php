<?php

namespace Controllers;

use Core\Request;

class UserController
{
    public function create(Request $request)
    {
        view('user/create', [
            'page_title' => 'Register'
        ]);
    }

    public function store(Request $request)
    {

    }
}