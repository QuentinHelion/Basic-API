<?php

/**
 * @file
 * UserCreator controller file.
 */

declare(strict_types=1);

namespace PAWeb\Controllers;

use PAWeb\Controller;

class Reports extends Controller
{
    private APIModel $model;

    public function __construct()
    {
        $this->model     = new APIModel();
    }

    public function post()
    {
        $body = $_POST;
        header("X-Powered-By: EasyScooter");
        header("Content-Type: application/api");
        if (empty($body["value"])) {
            http_response_code(412);
            header("error: missing information");
            die();
        }

        $res = $this->model->insert(
            array($body["value"])
        );
        if ($res == -1) {
            http_response_code(500);
            header("error: internal error");
            die();
        }

        http_response_code(201);
        header("result: insert report success");
        die();
    }

}
