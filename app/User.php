<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'firstname', 'lastname', 'email',
      'password', 'birthday', 'address', 'address2', 'zipcode', 'city', 'country',
      'gender', 'phone', 'salt', 'payment_iban', 'payment_bic',
      'mangopay_userid', 'mangopay_walletid', 'mangopay_cardId', 'parent_id', 'received_welcome_mail', 'emailValidate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'salt',

    ];

    /**
     * Get all of the order for the user where he is owner.
     */
    public function orders_owner()
    {
        return $this->hasMany(Order::class,'owner_id');
    }

    /**
     * Get all of the order for the user where he is buyer.
     */
    public function orders_buyer()
    {
        return $this->hasMany(Order::class,'buyer_id');
    }

    /**
     * Get all of the house for the user where he is owner of the wine.
     */
    public function houses_owner()
    {
        return $this->hasMany(House::class,'owner_id');
    }

    /**
     * Get all of the house for the user where he is buyer.
     */
    public function houses_buyer()
    {
        return $this->hasMany(House::class,'buyer_id');
    }
}
