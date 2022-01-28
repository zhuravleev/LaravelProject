<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UseModel extends Model
{
    use HasFactory;

    public function things(){
        return $this->hasMany(Thing::class, 'thing_id');
    }

    
    public function places(){
        return $this->hasMany(Place::class, 'place_id');
    }

    
    public function users(){
        return $this->hasMany(User::class, 'user_id');
    }
}
