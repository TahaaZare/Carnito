<?php

namespace Modules\Content\Entities\Projcet;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

}
