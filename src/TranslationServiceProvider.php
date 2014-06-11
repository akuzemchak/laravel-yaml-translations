<?php

namespace Kuz\Translation;

use Illuminate\Translation\TranslationServiceProvider as BaseProvider;
use Symfony\Component\Yaml\Parser;

class TranslationServiceProvider extends BaseProvider
{
    /**
     * {@inheritdoc}
     */
    protected function registerLoader()
    {
        $this->app->bindShared('translation.loader', function($app) {
            $parser = new Parser();

            return new YamlFileLoader($app['files'], $parser, $app['path'].'/lang');
        });
    }
}
