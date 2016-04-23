<?php

namespace DameMatiku\Controller;

use Silex\Application;

class BaseController
{
    protected function getSuccess() {
        return [
            "success" => TRUE
        ];
    }
}