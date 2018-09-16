<?php

namespace App;

use App\Notifications\OrderCompletedMail;
use App\Notifications\RestoreMail;
use App\Notifications\TicketSoldMail;
use App\Notifications\VerifyMail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use League\OAuth2\Server\Exception\OAuthServerException;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    const ROLES = ['superadmin','admin','guest'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'verify_token', 'restore_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function ticket_types() {
        return $this->belongsToMany(TicketType::class,'ticket_type_user');
    }
    public function scopeTicketCount()
    {
        return $this->tickets()->count();
    }
    public function scopeOrderCount()
    {
        return $this->orders()->count();
    }

    public function verified()
    {
        return $this->verify_token === null;
    }

    public function disabled()
    {
        return $this->restore_token !== null;
    }

    public function sendVerificationMail()
    {
        $this->notify(new VerifyMail($this));
    }

    public function sendRestoreMail()
    {
        $this->notify(new RestoreMail($this));
    }
    public function sendOrderCompletedMail($order)
    {
        $this->notify(new OrderCompletedMail($this, $order));
    }
    public function sendTicketSoldMail($ticket)
    {
        $this->notify(new TicketSoldMail($this, $ticket));
    }
    public function hasRole($role)
    {
        return $this->role == $role;
    }

    public function exists()
    {
        return $this->email !==null;
    }

    public function validateForPassportPasswordGrant($password) {
        if(Hash::check($password, $this->getAuthPassword())) {
            if($this->verify_token === null) {
                return true;
            } else {
                throw new OAuthServerException('Please verify your account before signing in.', 6, 'account_inactive', 401);
            }
        }
    }


}
