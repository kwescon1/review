<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    protected $table = 'car_models';

    protected $primaryKey = 'id';

    // protected $fillable = ['name', 'founded', 'description'];

    protected $hidden = ['created_at','updated_at'];

    protected $casts = ['created_at' =>'date:j F, y','updated_at' => 'date:j F, y'];

    //a car model belongs to a car
    public function car(){
        return $this->belongsTo(Car::class, 'car_id');
    }
}
