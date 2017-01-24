<?php

namespace App;

use App\User;
use App\File;
use Illuminate\Database\Eloquent\Model;

class UserFriendship extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user1Id', 'user2Id'
    ];

}
