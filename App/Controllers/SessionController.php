<?php

namespace Controllers;

use Core\Request;

class SessionController
{
    public function create()
    {
        view('session/create', [
            'page_title' => 'Login'
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|min:3|max:20',
            'password' => 'required'
        ]);

    }
}