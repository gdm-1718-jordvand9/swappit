<?php

namespace App;

use App\Notifications\OrderCompletedMail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Order extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at','placed_at'];
    protected $fillable = ['status','price','placed_at','cancelled_at','completed_at', 'payed_at'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function cancel()
    {
        if ($this->status === 'placed') {
            $tickets = $this->tickets()->get();
            foreach ($tickets as $ticket) {
                $ticket->update(['sold' => 0, 'published' => 1, 'order_id' => null]);
            }
            $this->update(['status' => 'cancelled', 'cancelled_at' => Carbon::now()]);

        }
    }

    public function trashed_user() {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function trashed_tickets() {
        return $this->hasMany(Ticket::class)->withTrashed();
    }
}
