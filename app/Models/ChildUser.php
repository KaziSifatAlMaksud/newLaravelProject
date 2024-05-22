<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\User;


class ChildUser extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;

    protected $table = 'child_users';

    protected $fillable = [
        'user_id', 'name','username', 'email', 'password',
        'status', 'reminder_date','birthday', 'send_status',
        'cover_photo', 'profile'
    ];
    public function parentInfo()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // public function profileInfo()
    // {
    //     return $this->hasOne(ProfileInfo::class, 'user_id', 'user_id');
    // }

    // public function videoinfo()
    // {
    //     return $this->hasMany(VideoInfo::class, 'child_id', 'id');
    // }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';  // Assuming 'id' is the primary key
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->{$this->getRememberTokenName()};
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->{$this->getRememberTokenName()} = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';  // Ensure your table has this column or adjust accordingly
    }
}










// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class ChildUser extends Model
// {
//     use HasFactory;

//     protected $table = 'child_users';

//     protected $fillable = ['user_id', 'name', 'email', 'password', 'status', 'reminder_date', 'send_status', 'cover_photo', 'profile'];
// }
