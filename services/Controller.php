<?php
namespace Services;
class Controller
{
    protected function render($view, $data = [])
    {
        extract($data);
        include "src/Views/$view.php";
    }
}