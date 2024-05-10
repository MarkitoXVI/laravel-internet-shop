<?php

namespace Models;

class Task extends Model
{
    static $table = 'tasks';

    protected array $fillable = ['title', 'description', 'user_id'];

}