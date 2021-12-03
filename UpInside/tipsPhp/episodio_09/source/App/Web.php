<?php

namespace Source\Web;

use League\Plates\Engine;
use Source\models\User;
use Source\Support\Seo;

/**
 * Description of Web
 *
 * @author Administrator
 */
class Web {

    private $view;
    private $seo;

    public function __construct() {
        $this->view = Engine::create(__DIR__ . "../../views/theme", "php");
        $this->seo = new Seo();
    }

    public function home(): void {
        $user = (new User())->find->fetch(true);
        $head = $this->seo->render(
                "Home | " . SITE,
                "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus ipsum iure voluptates eius eos quo!",
                url(),
                "https://via.placeholder.com/1200x628.png?text=Home+Cover",
        );

        echo $this->view->render("home", [
            "head" => $head,
            "users" => $users
        ]);
    }

    public function contact(): void {
        $head = $this->seo->render(
                "Contato | " . SITE,
                "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus ipsum iure voluptates eius eos quo!",
                url("contato"),
                "https://via.placeholder.com/1200x628.png?text=Contato+Cover",
        );

        echo $this->view->render("contact", [
            "head" => $head,
        ]);
    }

    public function error(array $data): void {

        $head = $this->seo->render(
                "Erro {$data['errcode']} | " . SITE,
                "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus ipsum iure voluptates eius eos quo!",
                url("ops/{$data['errcode']}"),
                "https://via.placeholder.com/1200x628.png?text=Erro+{$data['errcode']}",
        );
        echo $this->view->render("error", [
            "head" => $head,
            "error" => $data["errcode"]
        ]);
    }

}
