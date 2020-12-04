<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'classification',
        'minutes',
        'year',
        'cover',
        'trailer',
        'category_id', 
    ];

    public function category(){

        #return $this->belongsTo('App\Models\Category');

        return $this->belongsTo(Category::class);
    }
}
