<?php

namespace App\Transformers;

use App\Exceptions\JsonException;
use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\ParamBag;
use Carbon\Carbon;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Stripe;

class Apartment extends Fractal\TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [];

    public function transform(\App\Models\Apartment $apartment)
    {
        return [
            'name' => $apartment->name,
            'price' => $apartment->price,
            'bedrooms' => $apartment->bedrooms,
            'bathrooms' => $apartment->bathrooms,
            'storeys' => $apartment->storeys,
            'garages' => $apartment->garages,
        ];
    }
}
