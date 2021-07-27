<?PHP
namespace Plugins\Teams\Scripts;

class Teams{
    public static function AddTeam($user, $team)
    {
        $user->Update([
            'team' => $team->id
        ]);
    }

    public static function RemoveTeam($user, $team)
    {
        $user->Update([
            'team' => null
        ]);
    }

    public static function InTeam($user, $team)
    {
        if($user->team === $team->id)
        {
            return true;
        }
        return false;
    }

    public static function UserInTeam($user, $team)
    {
        $user = \Plugins\Auth\Scripts\Auth::user();
        return self::InTeam($user, $team);
    }
}