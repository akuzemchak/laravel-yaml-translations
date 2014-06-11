<?php

namespace Kuz\Translation\Tests;

use Illuminate\Container\Container;
use Kuz\Translation\TranslationServiceProvider;

class TranslationServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->app = new Container();
        $this->app['files'] = \Mockery::mock('Illuminate\Filesystem\Filesystem');
        $this->app['path'] = '.';
    }

    public function testItExtendsOriginalTranslationServiceProvider()
    {
        $this->assertInstanceOf(
            'Illuminate\Translation\TranslationServiceProvider',
            new TranslationServiceProvider($this->app)
        );
    }

    public function testItOverloadsOriginalTranslationLoader()
    {
        $provider = new TranslationServiceProvider($this->app);
        $provider->register();
        $provider->boot();

        $this->assertInstanceOf('Kuz\Translation\YamlFileLoader', $this->app->make('translation.loader'));
    }
}
