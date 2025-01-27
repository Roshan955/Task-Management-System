<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural form of the model
    // protected $table = 'tasks'; 

    // Fillable attributes for mass assignment
    protected $fillable = [
        'title', 
        'description', 
        'due_date', 
        'status', 
        'priority', 
        'user_id',
    ];

    // You can define attributes that should be cast into specific types
    protected $casts = [
        'due_date' => 'datetime',
    ];

    // Define relationships (task belongs to a user)
    public function user()
    {
        return $this->belongsTo(User::class);  // A task belongs to one user
    }

    // You could also define other helper methods for business logic here
    public function scopePending($query)
    {
        return $query->where('status', 'Pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'Completed');
    }

    // Accessor for status formatting (optional)
    public function getStatusAttribute($value)
    {
        return ucfirst(strtolower($value)); // Capitalize the status
    }

    // Mutator for setting due date
    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = \Carbon\Carbon::parse($value); // Ensure date is stored in proper format
    }

    // Additional business logic or custom methods for your Task model can go here
}
