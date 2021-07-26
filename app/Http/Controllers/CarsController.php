<?php

namespace App\Http\Controllers;

use App\Models\Car;
// use App\Models\Product;
use App\Services\Core;
use App\Http\Requests\CreateCarValidationRequest;

class CarsController extends Core
{
    //placing an authentication restriction on this conttoller except that index and show methods
    // public function __construct()
    // {
        // $this->middlrware('auth',['except'=> ['index','show']]);

    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index()
    {
        // return $this->getCacheKey("all");
        //SELECT * FROM cars
        // return view('cars.index',['cars' => Car::all()->makeVisible(['created_at','updated_at'])->toArray()]);
        return view('cars.index',['cars' => Car::cachedCars($this->getCacheKey("all"))]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCarValidationRequest $request)
    {
        //
        $request->validated();
         
        Car::create($request->all());
    
        $this->clearCache();

        return redirect('/cars');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return view('cars.show')->with('car',Car::cacheCar($this->getCacheKey($car->id)));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
    
        return view('cars.edit')->with('car',$car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCarValidationRequest $request, Car $car)
    {

        $request->validated();
        
        $car->update($request->all());

        $this->clearCache();
        
        return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {

        $car->delete();

        $this->clearCache();

        return redirect('/cars');
    }
}
