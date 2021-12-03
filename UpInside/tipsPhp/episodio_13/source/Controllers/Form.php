<?php

namespace Source\Controllers;

use League\Plates\Engine;
use Source\Controllers\User;

/**
 * Description of Form
 *
 * @author Administrator
 */
class Form {

    /** @var Engine */
    private $view;

    public function __construct() {
        $this->view = Engine::create(
                        dirname(__DIR__, 2) . "/views", "php"
        );

        $this->view->addData(["router" => $router]);
    }

    public function home(): void {
        $this->view->render("home", [
            "users" => (new User())->find()->order("first_name")->fetch(true)
        ]);
    }

    public function create(array $data): void {

        $userData = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        if (in_array("", $userData)) {
            $callback["message"] = message("Informe o noem eo sobrenome!", "error");
            echo json_decode($callback);
            return;
        }

        $user = new User();
        $user->first_name = $userData["first_name"];
        $user->last_name = $userData["last_name"];
        $user->save();

        $callback["message"] = message("Usuario cadastrado com sucesso!", "success");
        $callback["users"] = $this->view->Render("user", ["user" => $user]);
        echo json_encode($callback);
    }

    public function delete(array $data): void {
        if (empty($data["id"])) {
            return;
        }

        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $user = (new User())->findById($id);
        if ($user) {
            $user->destroy();
        }

        $callback["remove"] = true;
        echo json_encode($callback);
    }

}
