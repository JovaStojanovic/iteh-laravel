<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $guarded = ['id'];

    use HasFactory;

    public function musician(){
        return $this->belongsTo(Musician::class);
    }

    public function genre(){
        return $this->belongsTo(Genre::class);
    }
}
