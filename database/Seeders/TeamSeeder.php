<?PHP
  namespace Database\Seeders;
  use \Plugins\Teams\Models\Team;

  class TeamSeeder{

      public static function run()
      {
          Team::Create([
              'name' => 'Default Team'
          ]);
      }
  }
?>