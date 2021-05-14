<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'author', 'image', 'featured', 'category_id', 'publisher', 'sum'
    ];

    public function deleteImage()
    {
        Storage::delete($this->image);
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function rent()
    {
        return $this->hasOne(Rent::class);
    }

    public function hasCategory($categoryId)
    {
        return in_array($categoryId, $this->categories->pluck('id')->toArray());
    }
    /**
     * check if post has tag
     * 
     * @return bool
     */
    public function hasUser($userId)
    {
        return in_array($userId, $this->users->pluck('id')->toArray());
    }

    public function scopeSum($query)
    {
        return $query->where('sum', '=>', 1);
    }

    public function scopeSearched($query)
    {
        $search = request()->query('search');

        if (!$search) {
            return $query;
        }

        return $query->where('title', 'LIKE', "%{$search}%");
    }
}
