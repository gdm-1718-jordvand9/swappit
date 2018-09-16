<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketType extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'price',
        'description',
        'sale_open',
        'sale_start_date',
        'sale_end_date',
        'festival_id'
    ];

    public function festival()
    {
        // withtrashed
        return $this->belongsTo(Festival::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function scopeAvailable()
    {
        return $this->tickets()->where(['sold' => 0, 'published' => 1])->get();
    }

    public function users() {
        return $this->belongsToMany(User::class, 'ticket_type_user');
    }

    public function ticketsAvailable()
    {
        return $this->hasMany(Ticket::class)->where(['sold' => 0, 'published' => 1]);
    }

    public function ticketsSold()
    {
        return $this->hasMany(Ticket::class)->where('sold', 1);
    }


    public function scopeTicketCount()
    {
        return $this->tickets()->count();
    }

    public function scopeOnSale($query)
    {
        return $query->whereDate('sale_start_date', '<=', Carbon::today())
            ->whereDate('sale_end_date', '>=', Carbon::today());
    }
    public function scopeNotOnSale($query)
    {
        return $query->whereDate('sale_start_date', '>', Carbon::today())
            ->orWhereDate('sale_end_date', '<', Carbon::today());
    }

    public function scopeTicketSoldCount()
    {
        return $this->tickets()->where('sold', '1')->count();
    }
    public function scopeTicketAvailableCount($query)
    {
        return $query->whereHas('tickets', function ($q) { $q->Available()->count();});
    }

    public function scopeIsSaleOpen() {
        if(Carbon::parse($this->sale_start_date) <= Carbon::now() && Carbon::parse($this->sale_end_date) >= Carbon::now()) {
            return 'true';
        }
        return 'false';
    }


    /*public function setSaleOpenAttribute($value)
    {
        $this->attributes['sale_open'] = ($value == 'on') ? '1' : '0';
    }*/

    /*public function getSaleOpenAttribute($value)
    {
        return ($value == '1') ? 'true' : 'false';
    }*/
    // Backoffice
    public function trashed_festival()
    {
        // withtrashed
        return $this->belongsTo(Festival::class, 'festival_id')->withTrashed();
    }

}
