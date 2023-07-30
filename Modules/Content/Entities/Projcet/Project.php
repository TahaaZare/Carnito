<?php

namespace Modules\Content\Entities\Projcet;

use App\Http\Resources\ProjectResource;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory, Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'slug'
            ]
        ];
    }

    protected $fillable = [
        'name',
        'description',
        'image',
        'status',
        'slug',
        'category_id',
    ];

    public function projectCategory()
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }

    public static function getProjects()
    {
        $projects = Project::all();
        return ProjectResource::collection($projects);
    }
}
