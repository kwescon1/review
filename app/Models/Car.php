<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\CarResource;


class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'founded', 'description'];

    //used to hide certain data we dont want to show
    // the resource class can be used in place of the this hidden attribute

    // protected $hidden = ['created_at','updated_at'];

    // protected $visible = []; show specific data.. opposite of hidden.. whitelisting


    protected $casts = ['created_at' =>'date:j F, y','updated_at' => 'date:j F, y'];
   
    //a car has many models
    public function carModels(){
        return $this->hasMany(CarModel::class, 'car_id');
    }
    //hasManyThrough accepts 2 arguments.. 1st is thr name of the model we wish to access,
    //the second is the name of the intermediate model ie the model we need to access the first model
    public function engines(){
        return $this->hasManyThrough(
            Engine::class, 
            CarModel::class,
            
            //write the fk of the second model first ie car_id since the car model has a link with CarModel and 
            //write the model_id FK second
            'car_id', // FK on Car model table
            'model_id' //FK on engine table
        );
    }

    //define a has one through relationship
    public function productionDate(){
        return $this->hasOneThrough(
            CarProductionDate::class,
            CarModel::class,

            'car_id', //FK on car model tabe
            'model_id' //FK on production date table

        );
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public static function allCars(){
        
        return CarResource::collection(Car::all());
    }
}
