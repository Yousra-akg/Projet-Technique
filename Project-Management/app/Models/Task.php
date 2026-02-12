<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image',
        'projet',
        'user_id',
    ];

    public function projects() {
        return $this->belongsToMany(Project::class);
    }
}
