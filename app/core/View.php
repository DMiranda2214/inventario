<?php

namespace App\Core;

class View {
    public static function load($viewName, $data = []) {
        extract($data);
        require "../app/views/$viewName.php";
    }
}
