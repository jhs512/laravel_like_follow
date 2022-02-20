<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ReactionPoint;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;

class ReactionPointController extends Controller
{
    public function makeBad(string $reactionPointableType, int $reactionPointableId)
    {
        return $reactionPointableType;
    }

    public function cancelBad(string $reactionPointableType, int $reactionPointableId)
    {
    }

    public function makeGood(string $simpleReactionPointableType, int $reactionPointableId)
    {
        Gate::authorize('makeGoodReactionPoint', [ReactionPoint::class, $simpleReactionPointableType, $reactionPointableId]);

        ReactionPoint::makeGood($simpleReactionPointableType, $reactionPointableId, auth()->user()->id);

        return '성공 ^ ^';
    }

    public function cancelGood(string $reactionPointableType, int $reactionPointableId)
    {
        //
    }
}
