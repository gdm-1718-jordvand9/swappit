<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Festival extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'slug',
        'place',
        'description',
        'start_date',
        'end_date',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'snapchat_url',
    ];

    public function scopeSaleOpen($query) {

        return $query->where('sale_open', 0 );
    }


    public function tickets()
    {
        return $this->hasManyThrough(Ticket::class, TicketType::class);
    }

    public function ticket_types()
    {
        return $this->hasMany(TicketType::class);
    }
}
