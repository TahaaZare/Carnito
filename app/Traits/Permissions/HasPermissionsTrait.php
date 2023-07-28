<?php

namespace App\Traits\Permissions;

trait HasPermissionsTrait
{
    protected function hasPermision($permission)
    {
        return  (bool)$this->permissions->where('name', $permission->name)->count();
    }

    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }
        return false;
    }
    public function hasPermission(...$permissions)
    {
        foreach ($permissions as $permission) {
            if ($this->permissions->contains('name', $permission)) {
                return true;
            }
        }
        return false;
    }

    public function hasPermissionTo($permission)
    {
        return $this->hasPermision($permission) || $this->hasPermisionThroughRole($permission);
    }

    public function hasPermisionThroughRole($permission)
    {
            foreach($permission ->roles as $role){
                if($this->roles->contains($role)){
                    return true;
                }
            }
            return false;
    }

    
}
