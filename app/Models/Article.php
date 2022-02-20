<?php

namespace App\Models;

use App\Models\ReactionPoint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    public function getThumbImgUrlAttribute()
    {
        if ($this->img_1) {
            return asset('storage/' . $this->img_1);
        }

        return "https://via.placeholder.com/500/DFDFDF/000000?text=^_^";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reaction_points()
    {
        return $this->morphMany(ReactionPoint::class, 'reaction_pointable');
    }
}
