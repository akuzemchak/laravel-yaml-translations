<?php

namespace Kuz\Translation;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Symfony\Component\Yaml\Parser;

class YamlFileLoader extends FileLoader
{
    /**
     * The YAML parser instance
     *
     * @var \Symfony\Component\Yaml\Parser
     */
    protected $parser;

    /**
     * Create a new file loader instance
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     * @param \Symfony\Component\Yaml\Parser $parser
     * @param string $path
     * @return void
     */
    public function __construct(Filesystem $files, Parser $parser, $path)
    {
        $this->path = $path;
        $this->files = $files;
        $this->parser = $parser;
    }

    /**
     * {@inheritdoc}
     */
    protected function loadNamespaceOverrides(array $lines, $locale, $group, $namespace)
    {
        $file = "{$this->path}/packages/{$locale}/{$namespace}/{$group}.yml";

        if ($this->files->exists($file)) {
            return array_replace_recursive($lines, $this->loadYaml($file));
        }

        // Check for PHP version if no YAML file
        return parent::loadNamespaceOverrides($lines, $locale, $group, $namespace);
    }

    /**
     * {@inheritdoc}
     */
    protected function loadPath($path, $locale, $group)
    {
        if ($this->files->exists($full = "{$path}/{$locale}/{$group}.yml")) {
            return $this->loadYaml($full);
        }

        // Check for PHP version if no YAML file
        return parent::loadPath($path, $locale, $group);
    }

    /**
     * Load the YAML content
     *
     * @param string $path
     * @return array
     */
    protected function loadYaml($path)
    {
        $content = $this->files->get($path);

        return (array) $this->parser->parse($content);
    }
}
