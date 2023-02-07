<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // protected $guarded = [];

    protected $fillable = ['name'];

    /**
     * The offers that belong to the category.
     */
    public function offers()
    {
        return $this->belongsToMany(Offer::class);
    }
}