<?PHP
namespace Plugins\Ranks\Scripts;
use \App\Models\User;
use \Plugins\Ranks\Models\Rank;

class Ranks{
    public static function AddRank($user, $rank)
    {
        $user->Update([
            'rank' => $rank->id
        ]);
    }

    public static function RemoveRank($user)
    {
        $user->Update([
            'rank' => null
        ]);
    }

    public static function HasRank($user, $rank)
    {
        if($user->rank === $rank->id)
        {
            return true;
        }
        return false;
    }

    public static function HasHigherRank($user, $rank)
    {
        if(is_null($user->rank))
        {
            return false;
        }
        $userrank = Rank::find($user->rank);
        if(Rank::IsHigher($rank, $userrank))
        {
            return true;
        }
        return false;
    }
}
?>