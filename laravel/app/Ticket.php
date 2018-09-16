<?php

namespace App;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class Ticket extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'price',
        'code',
        'start_date',
        'end_date',
        'bump_date',
        'published',
        'ticket_type_id',
        'user_id',
        'order_id',
        'sold',
    ];
    // Backoffice

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ticket_type()
    {
        return $this->belongsTo(TicketType::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function festival()
    {
        return $this->hasManyThrough(Festival::class,TicketType::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where(['published' => 1, 'sold' => 0, 'order_id' => null]);
    }

    public function scopeSold($query)
    {
        return $query->where('sold', 1);
    }

    public function scopeLatestBump($query)
    {
        return $query->orderBy('bump_date', 'desc');
    }

    // Trashed relationships
    public function trashed_ticket_type()
    {
        return $this->belongsTo(TicketType::class, 'ticket_type_id')->withTrashed();
    }

    public function trashed_user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function trashed_order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
}
