<?php

namespace Source\Core;

use League\Plates\Engine;

/**
 * Description of View
 *
 * @author luiscarlosss
 */
class View {

    private $engine;

    /**
     *
     * @param string $path
     * @param string $ext
     */
    public function __construct(string $path = CONF_VIEW_PATH, string $ext = CONF_VIEW_EXT) {
        $this->engine = Engine::create($path, $ext);
    }

    /**
     *
     * @param string $name
     * @param string $path
     * @return \Source\Core\View
     */
    public function path(string $name, string $path): View{
        $this->engine->addFolder($name, $path);
        return $this;
    }

    /**
     *
     * @param string $templateName
     * @param array $data
     * @return string
     */
    public function render(string $templateName, array $data): string{
        return $this->engine->render($templateName, $data);
    }

    /**
     *
     * @return Engine
     */
    public function engine(): Engine{
        return $this->engine();
    }
}
