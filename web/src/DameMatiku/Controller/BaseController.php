<?php

namespace DameMatiku\Controller;

use Silex\Application;

class BaseController
{
	const USER_ID = 1;
	protected $user;

	public function getUser(Application $app) {
		return $app['repository.user']->find(self::USER_ID);
	}

    protected function getSuccess() {
        return [
            "success" => TRUE
        ];
    }
}