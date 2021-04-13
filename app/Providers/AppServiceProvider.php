<?php

namespace App\Providers;

use App\Serializers\MetaArraySerializer;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('League\Fractal\ScopeFactoryInterface', 'League\Fractal\ScopeFactory');
    }

    /**
     * Bootstrap any application services.
     *
     * @param \League\Fractal\Manager $fractal
     * @return void
     */
    public function boot(Manager $fractal)
    {
        $fractal->setSerializer(new MetaArraySerializer());

        ResponseFactory::macro('collection', function ($data, $transformer, $status = 200, Array $meta = []) use ($fractal) {
            if (\Request::has('include')) {
                $fractal->parseIncludes(\Request::input('include'));
            }

            return response()->json(array_merge($fractal->createData(new Collection($data, new $transformer))->toArray(), $meta), $status);
        });

        ResponseFactory::macro('item', function ($data, $transformer, $status = 200, Array $meta = []) use ($fractal) {
            if (\Request::has('include')) {
                $fractal->parseIncludes(\Request::input('include'));
            }

            return response()->json(array_merge($fractal->createData(new Item($data, new $transformer))->toArray(), $meta), $status);
        });
    }
}
