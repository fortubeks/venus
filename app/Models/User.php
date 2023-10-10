<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'user_type',
        'hotel_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function boot()
    {
        parent::boot();

        // Define the created event listener
        static::created(function ($model) {
            // Perform your function or action here
            // You can access the model's attributes using $model->attribute_name
            if($model->user_type == "super_admin"){
                Hotel::create(['user_id' => $model->id]);
            }
            
        });
    }

    public function hotel()
    {
        return $this->belongsTo('App\Models\Hotel');
    }
    public function hotels()
    {
        return $this->hasMany('App\Models\Hotel');
    }
    public function userAccount(){
        return $this->hasOne('App\Models\User', 'user_account_id');
    }

}
