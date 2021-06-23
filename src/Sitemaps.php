<?php
namespace GreenCheap\Seo;

use GreenCheap\Application as App;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class Sitemaps
{
    /**
     * @var array
     */
    protected array $modules = [];

    /**
     * Sitemaps constructor.
     */
    public function __construct()
    {
        $this->setPackages();
    }

    /**
     * @return void
     */
    public function setPackages(): void
    {
        $modules = App::module()->all();
        foreach ($modules as $module) {
            $config = $module->options;
            if (array_key_exists("sitemaps", $config)) {
                foreach ($config["sitemaps"] as $key => $sitemapModule) {
                    $this->modules[$key] = $sitemapModule;
                }
            }
        }
    }

    /**
     * @return array
     */
    #[ArrayShape]
    public function getAll(): array
    {
        return $this->modules;
    }

    /**
     * @param $key
     * @return object|bool
     */
    #[Pure]
    public function get($key): object|bool
    {
        if (array_key_exists($key, $this->modules)) {
            return (object) $this->modules[$key];
        }

        return false;
    }
}
