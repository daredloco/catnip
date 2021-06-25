<?PHP
namespace Plugins\Ranks\Scripts;
use \App\Models\User;
use \App\Models\Rank;

class Ranks{
    public static function AddRank(User $user, Rank $rank)
    {
        $user->Update([
            'rank' => $rank->id
        ]);
    }

    public static function RemoveRank(User $user)
    {
        $user->Update([
            'rank' => null
        ]);
    }

    public static function HasRank(User $user, Rank $rank)
    {
        if($user->rank === $rank->id)
        {
            return true;
        }
        return false;
    }

    public static function HasHigherRank(User $user, Rank $rank)
    {
        if(is_null($user->rank))
        {
            return false;
        }
        $userrank = Rank::find($user->rank);
        if(Rank::IsHigher($rank->score, $userrank->score))
        {
            return true;
        }
        return false;
    }
}
?>