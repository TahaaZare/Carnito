<?php

namespace Modules\Content\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'teams';
    protected $fillable = [
        'first_name',
        'last_name',
        'instagram_link',
        'telegram_link',
        'image',
        'status',
        'team_role',
        'bio'
    ];
}
