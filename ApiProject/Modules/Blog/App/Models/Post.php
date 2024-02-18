<?php

namespace Modules\Blog\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Blog\Database\factories\PostFactory;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name','content', 'userId','image'];
    
    protected static function newFactory()
    {
        //return PostFactory::new();
    }

    public function users(){
        return $this->belongsTo(User::class,'userId');
    }
}
