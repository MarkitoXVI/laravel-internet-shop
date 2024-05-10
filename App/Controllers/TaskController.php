<?php

namespace Controllers;

class TaskController
{
    public function index()
    {
        view('tasks/index', [
            'page_title' => 'My Tasks'
        ]);
    }
}