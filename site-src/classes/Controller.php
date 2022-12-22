<?php

/**
 * @file
 * Controllers class file.
 */

declare(strict_types=1);

namespace PAWeb;

use PAWeb\Models\UserModel;

abstract class Controller
{
    public function render(string $template, array $data = array()): void
    {
        $tpl_engine = $GLOBALS["Views"];

        $arr = explode(".", $template);
        if (end($arr) !== "tpl") {
            $template .= ".tpl";
        }

        foreach ($data as $key => $value) {
            $tpl_engine->assign($key, $value);
        }

        $model = new UserModel();
        session_start();
        $res = !empty($_SESSION["id"]) ? $model->fetchOne($_SESSION["id"]) : null;
        $tpl_engine->assign("perms", $res["perms"]);

        $tpl_engine->display($template);
    }


    public function redirect($uri)
    {
        header("Location: /$uri");
        header("Connection: close");
    }
}
