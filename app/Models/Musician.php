<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Musician extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];
    use HasFactory;

    public function songs(){
        return $shows = $this->hasMany(Song::class);
    }
}
