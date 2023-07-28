<?php

namespace Modules\Role\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Permission\Entities\Permission;

class Role extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
