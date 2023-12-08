<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Laravel\Prompts\search;

class Post extends Model
{
    use HasFactory;


    protected $with = ['category','author'];
    protected $fillable = ['title','slug','excerpt','body'];

    public function scopeFilter($query, array $filters)
    {
        if($filters['search'] ?? false)
        {
            $query
                ->where('title','like','%'.$filters['search'].'%')
                ->orWhere('body','like','%'.$filters['search'].'%');

        }
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
        {
            return $this->belongsTo(User::class,'user_id');
        }

}
