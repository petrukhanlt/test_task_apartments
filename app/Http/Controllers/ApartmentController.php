<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexApartmentRequest;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    protected Apartment $apartment;

    public function __construct(Apartment $apartment)
    {
        $this->apartment = $apartment;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Requests\IndexApartmentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(IndexApartmentRequest $request)
    {
        $query = $this->apartment->query($request->all());

        $count = $query->count();

        if ($request->has('skip')) {
            $query = $query->offset($request->get('skip'));
        }

        $query = $query->take(($request->get('count') == 'all') ? $count : $request->get('count', 9));

        // returns prepared response with Fractal
        return response()->collection($query->get(), '\App\Transformers\Apartment');
    }
}
