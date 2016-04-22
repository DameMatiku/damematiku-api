<?php

use Silex\Application;

class BaseController
{
    protected function getSuccess() {
        return [
            "success" => TRUE
        ];
    }
}