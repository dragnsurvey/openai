<?php

namespace Dragnsurvey\OpenAi;

use Illuminate\Support\ServiceProvider;
class OpenAiServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('dragnsurvey-chatgpt', function ($app) {
            return new OpenAI();
        });
    }

    public function boot()
    {
        // Publish configuration file
        $this->mergeConfigFrom(
            __DIR__.'/../config/openai.php', 'openai'
        );
    }

}
