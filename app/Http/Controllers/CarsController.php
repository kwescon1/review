<?php

namespace App\Http\Controllers;

use App\Models\Car;
// use App\Models\Product;
use App\Http\Requests\CreateCarValidationRequest;

class CarsController extends Controller
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
        //SELECT * FROM cars
        // return view('cars.index',['cars' => Car::all()->makeVisible(['created_at','updated_at'])->toArray()]);
        return view('cars.index',['cars' => Car::allCars()]);
       
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
         
        Car::create([
            'name' => $request->name,
            'founded' => $request->founded,
            'description' => $request->description
        ]);

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
        return view('cars.show')->with('car',$car);
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
        
        $car->update([
            'name' => $request->name,
            'founded' => $request->founded,
            'description' => $request->description
        ]);

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

        return redirect('/cars');
    }
}
