<?php

namespace App\Models;

use App\Models\User;
use App\Models\OfferImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory;


    // protected $guarded = [];

    protected $fillable = [
        'title',
        'address',
        'city',
        'zip_code',
        'province',
        'priority',
        'vacant_positions',
        'description',
        'requirements',
        'subscriptionStartDate',
        'subscriptionEndDate',
        'activityStartDate',
        'activityEndDate'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'requirements' => 'array',
        // 'subscriptionStartDate' => 'datetime:Y-m-d'
    ];


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'subscriptionStartDate',
        'subscriptionEndDate'
    ];

    /**
     * The categories that belong to the offer.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * The users that subscribed to the offer.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * The images that belong to an offer.
     */
    public function images()
    {
        return $this->hasMany(OfferImage::class, 'offer_id', 'id');
    }
}
