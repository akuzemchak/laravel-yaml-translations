<?php

namespace Kuz\Translation\Tests;

use Illuminate\Filesystem\Filesystem;
use Kuz\Translation\YamlFileLoader;
use Symfony\Component\Yaml\Parser;

class YamlFileLoaderTest extends \PHPUnit_Framework_TestCase
{
    protected $files;
    protected $parser;
    protected $path;
    protected $loader;

    protected function setUp()
    {
        $this->files = new Filesystem();
        $this->parser = new Parser();
        $this->path = __DIR__ . '/fixtures';
        $this->loader = new YamlFileLoader($this->files, $this->parser, $this->path);
    }

    public function testItExtendsOriginalFileLoader()
    {
        $this->assertInstanceOf('Illuminate\Translation\FileLoader', $this->loader);
    }

    public function testItLoadsYamlLanguageFiles()
    {
        $result = array('what' => 'Hello', 'who' => 'World');

        $this->assertEquals($result, $this->loader->load('en', 'hello'));
    }

    public function testItLoadsNamespacedYamlLanguageFiles()
    {
        $result = array('what' => 'Howdy', 'who' => 'Y\'all');
        $this->loader->addNamespace('texan', __DIR__ . '/fixtures/namespaced/texan');

        $this->assertEquals($result, $this->loader->load('en', 'hello', 'texan'));
    }

    public function testItFallsBackToPhpLanguageFiles()
    {
        $result = array('what' => 'Goodbye', 'who' => 'World');

        $this->assertEquals($result, $this->loader->load('en', 'goodbye'));
    }
}
