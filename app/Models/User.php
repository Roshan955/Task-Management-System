<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Default table name is 'users', no need to define it unless changed

    // The attributes that are mass assignable
    protected $fillable = [
        'name', 
        'email', 
        'password',
    ];

    // The attributes that should be hidden for arrays
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    // The attributes that should be cast to native types
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship to Task (User has many tasks)
    public function tasks()
    {
        return $this->hasMany(Task::class); // A user can have many tasks
    }

    // For login authentication, ensure password is hashed and compared properly
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = bcrypt($value); // Automatically hash password when set
        }
    }

    // Custom function to check if the user has any tasks
    public function hasTasks()
    {
        return $this->tasks()->count() > 0;
    }

    // Additional user-specific business logic or helper methods
}
