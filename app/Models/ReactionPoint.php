<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReactionPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'reaction_pointable_type',
        'reaction_pointable_id',
        'user_id',
        'point',
    ];

    public static function findBy(string $simpleReactionPointableType, int $reactionPointableId, int $userId)
    {
        $reactionPointableType = static::getReactionPointableTypeBy($simpleReactionPointableType);
        return ReactionPoint::where('reaction_pointable_type', $reactionPointableType)->where('reaction_pointable_id', $reactionPointableId)->where('user_id', $userId)->first();
    }

    public static function makeGood(string $simpleReactionPointableType, int $reactionPointableId, int $userId)
    {
        $reactionPointableType = static::getReactionPointableTypeBy($simpleReactionPointableType);

        $reactionPoint = static::create([
            'reaction_pointable_type' => $reactionPointableType,
            'reaction_pointable_id' => $reactionPointableId,
            'user_id' => $userId,
            'point' => 1,
        ]);

        $reaction_pointable = $reactionPoint->reaction_pointable;

        $goodReactionPointSum = static::where('reaction_pointable_type', $reactionPointableType)
            ->where('reaction_pointable_id', $reactionPointableId)
            ->where('point', '>', 0)
            ->sum('point');

        $reaction_pointable->good_reaction_point = $goodReactionPointSum;
        $reaction_pointable->save();
    }

    public static function getReactionPointableTypeBy(string $simpleReactionPointableType)
    {
        return 'App\\Models\\' . ucfirst($simpleReactionPointableType);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reaction_pointable()
    {
        return $this->morphTo();
    }
}
