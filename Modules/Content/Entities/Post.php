<?php

namespace Modules\Content\Entities;

use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Comment\Entities\Comment;

class Post extends Model
{
    use HasFactory, SoftDeletes, Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'slug'
            ]
        ];
    }
    protected $casts = ['image' => 'array'];
    protected $fillable = [
        'name', 'summary',
        'slug', 'image', 'status', 'tags', 'description', 'published_at', 'author_id', 'category_id', 'comment_able'
    ];

    public function postCategory()
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function activeComments()
    {
        return $this->comments()->where('approved', 1)->where('status', 1)->whereNull('parent_id')->get();
    }
}
