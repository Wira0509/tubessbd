<?php
namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Monolog\Handler\WebRequestRecognizerTrait;
use function PHPUnit\Framework\returnArgument;

class Comment extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function childrens()
    {
        return $this->hasMany(Comment::class);
    }

    public function hasLike()
    {
        return $this->hasOne(Like::class)->where('likes.user_id', Auth::user()->id);
    }

    public function totalLikes()
    {
        return $this->hasMany(Like::class)->count();
    }
}
