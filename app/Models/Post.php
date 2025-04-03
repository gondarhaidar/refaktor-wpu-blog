<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    protected $with = ['user'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment(){
        return $this->hasMany(Comment::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when(
            $filters['search'] ??  false,
            fn($query, $search) =>
            $query->where('title', 'like', '%' . $search . '%')
        );

        $query->when(
            $filters['user'] ?? false,
            fn($query, $user) =>
            $query->whereHas('user', fn($query) => $query->where('name', $user))
        );
        $query->when(
            $filters['category'] ?? false,
            fn($query, $category) =>
            $query->whereHas('category', fn($query) => $query->where('slug', $category))
        );
    }
}
