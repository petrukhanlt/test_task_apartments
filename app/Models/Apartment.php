<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'bedrooms',
        'bathrooms',
        'storeys',
        'garages',
    ];

    /**
     * @param null $query
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public static function query($query = null)
    {
        $apartments = new static;
        $apartmentParams = ['bedrooms', 'bathrooms', 'storeys', 'garages'];

        if (isset($query['name'])) {
            $apartments = $apartments->where('name', 'LIKE', "%{$query['name']}%");
        }

        if (isset($query['price_from'])) {
            $apartments = $apartments->where('price', '>=', $query['price_from']);
        }

        if (isset($query['price_to'])) {
            $apartments = $apartments->where('price', '<=', $query['price_to']);
        }

        foreach ($apartmentParams as $param) {
            if (isset($query[$param])) {
                $apartments = $apartments->where($param, $query[$param]);
            }
        }

        return $apartments;
    }
}
