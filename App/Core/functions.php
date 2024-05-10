<?php

function dd($data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

function base_path($path = '') {
    return BASE_PATH . $path;
}

function view($view, $attributes = []) {
    extract($attributes);
    require base_path('views/' . $view . '.view.php');
}

function component($component, $attributes = []) {
    extract($attributes);
    require base_path('views/components/' . $component . '.php');
}

function errors() {
    if (isset($_COOKIE['errors'])) {
        $errors = json_decode($_COOKIE['errors'], true);
        setcookie('errors', '', time() - 3600, $_SERVER['REQUEST_URI']);
    }
    return $errors ?? [];
}
