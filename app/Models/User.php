<?php



namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // match your actual database table
    protected $table = 'user';

    // match your primary key
    protected $primaryKey = 'IDUser';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false; // your table doesn't have created_at / updated_at

    // match column names in your database
    protected $fillable = [
        'Nama',
        'Email',
        'Password',
        'Jabatan',
    ];

    // if you ever call $user->password, it will return the correct column
    public function getAuthPassword()
    {
        return $this->Password;
    }

    // hide sensitive info if you ever return JSON
    protected $hidden = [
        'Password',
    ];
}
