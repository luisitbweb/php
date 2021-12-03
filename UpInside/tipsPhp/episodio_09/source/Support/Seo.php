<?php

namespace Source\Support;

use CoffeeCode\Optimizer\Optimizer;

/**
 * Description of Seo
 *
 * @author Administrator
 */
class Seo {

    protected $optmizer;

    public function __construct(string $schema = "article") {
        $this->optmizer = new Optimizer();
        $this->optmizer->openGraph(
                SITE,
                "pt_BR",
                $schema
        )->publisher(
                "luisitb",
                "46416846455"
        )->twitterCard(
                "@luisitb",
                "@test",
                "localhost"
        )->facebook(
                null,
                [
                    "46435464648654",
                    "46134635456465"
                ]
        );
    }

    public function render(string $title, string $description, string $url, string $image, string $follow) {
        return $this->optmizer->optimize(
                $title,
                $description,
                $url,
                $image,
                $follow
        )->render();
       
    }

}
