<?php

namespace BenArgo\JsonSchema;

use BenArgo\JsonSchema\SchemaInterface;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use JsonSchema\SchemaStorageInterface as SchemaStorage;
use JsonSchema\Validator;
use JsonSchema\Constraints\Factory;
use JsonSchema\Constraints\ConstraintInterface as Constraint;

/**
 * Service provider to register the parent library.
 *
 * @package laravel-json-schema
 * @author  Ben Argo <ben@benargo.com>
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SchemaStorage::class, function ($app) {
            return new SchemaStorage;
        });

        $this->app->bind(Factory::class, function ($app) {
            return new Factory($app->make(SchemaStorage::class));
        });

        $this->app->bind(Validator::class, function ($app) {
            return new Validator;
        });

        $this->app->when(Validator::class)
                  ->needs(Factory::class)
                  ->give(function ($app) {
                      return $app->make(Factory::class);
                  });
    }
}
