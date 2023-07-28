<?php

namespace Modules\Site\Entities\SalesProcess;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Counseling\Entities\Counseling;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'info_consultant_id','description'];

    public function info()
    {
        return $this->belongsTo(Counseling::class, 'info_consultant_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
