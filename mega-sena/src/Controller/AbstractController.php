<?php

namespace PaginaEmConstrucao\Controller;

use League\Plates\Engine;

abstract class AbstractController {

    /** @var Engine */
    protected $engine;

    public function __construct()
    {
        $this->engine = Engine::create(CONF_VIEW_PATH . "/" . CONF_VIEW_THEME, CONF_VIEW_EXT);
    }

    /**
     * 
     * @param string $name
     * @param string $path
     * @return Engine
     */
    public function path(string $name, string $path): Engine
    {
        $this->engine->addFolder($name, $path);
        return $this->engine;
    }

    public function render(string $templateName, array $data): string
    {
        return $this->engine->render($templateName, $data);
    }

    public function setCache(string $name, $data): bool
    {
        $file = __DIR__ . "/../../storage/cache/" . $name . ".cache";
        
        file_put_contents($file, serialize($data));
        
        return is_file($file);
    }
    
    public function getCache(string $name) {
        $file = __DIR__ . "/../../storage/cache/" . $name . ".cache";
        
        if (is_file($file)) {
            return unserialize(file_get_contents($file));
        }
        
        return false;
    }

}
