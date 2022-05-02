<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
		'phone',
        'user_permission',
        'user_status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function attendance()
    {
        return $this->hasOne(Attendance::class);
    }
    public function department()
    {
        return $this->hasOne(Department::class);
    }
    public function event()
    {
        return $this->hasOne(Event::class);
    }
    public function leaves()
    {
        return $this->hasOne(Leaves::class);
    }
    public function manage_salary()
    {
        return $this->hasOne(ManageSalaries::class);
    }
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    public function user_meta()
    {
        return $this->hasOne(UserMeta::class);
    }
}
