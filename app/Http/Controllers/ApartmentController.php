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

        // returns prepared response with Fractal
        return response()->collection($query->get(), '\App\Transformers\Apartment');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
