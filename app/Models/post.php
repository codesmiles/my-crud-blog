<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeFilter($query, array $filters)
    {
        if ($filters['title'] ?? false) {
            return $query->where('title', 'like', '%' . $filters['title'] . '%');
        };

        if ($filters['search'] ?? false) {
            return $query->where('title', 'like', '%' . $filters['title'] . '%')
                ->orwhere('content', 'like', '%' . request('content') . '%')
                ->orwhere('slug', 'like', '%' . request('user_id') . '%');
        };
    }
}
