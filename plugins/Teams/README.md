# Teams Plugin for Catnip

### Requirements

To use all functions in this plugin you'll need the Auth plugin or create an own 'users' table with a team row as integer!

### Installation
With Locito:
* Run ``` php locito make:table Team ```
* Replace the content in ```database/Tables/TeamTable.php``` with the following lines:
  ```php
  <?PHP
  namespace Database\Tables{

      use \Catnip\Table;

      class TeamTable{
          public static function build()
          {
              $table = new Table("teams", [
                  "id" => "INT|AUTO_INCREMENT|PRIMARY KEY",
                  "name" => "VARCHAR(255)|NOT NULL"
                  "created_at" => "TIMESTAMP|DEFAULT|CURRENT_TIMESTAMP"
              ]);
              $table->Create();
          }

          public static function destroy()
          {
              $table = new Table("teams");
              $table->Drop();
          }
      }
  }
  ?>
  ```
* Run ```php locito make:seeder Team```
* Add the following lines to ```database/Tables/TeamSeeder.php```:
  ```php
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
  ```
* Open ```database\Tables\UserTable.php``` and add line:
  ```php
  $table = new \Catnip\Table("users", [
                "id" => "INT|AUTO_INCREMENT|PRIMARY KEY",
                "name" => "VARCHAR(255)|NOT NULL",
                "password" => "VARCHAR(255)|NOT NULL",
                "email" => "VARCHAR(255)|NOT NULL",
                "created_at" => "TIMESTAMP|DEFAULT|CURRENT_TIMESTAMP",
                "team" => "INT" //ADD THIS LINE
            ],
            ['team' => 'teams'] //ADD THIS LINE TO MAKE 'team' a foreign key
  ```

* Add those lines before the end of the ```Compile``` function in ```\catnip\View.php``` to extend the Templating System (MAKE A BACKUP!):
```php
//Handle AUTH plugin 
$newcontent = preg_replace("/@InTeam\((.*)\)/", "<?PHP if(\Plugins\Teams\Scripts\Teams::UserInTeam(\Plugins\Teams\Models\Team::FindByName($1))){?>", $newcontent);
$newcontent = preg_replace("/@endInTeam/", "<?PHP } ?>", $newcontent);

//ADD BEFORE THIS LINE
if($cache)
{
        $newcontent .= "<?PHP \\Catnip\\Cache::CacheEnd(); ?>";
}
```

* Run ```php locito db:build --fresh --seed``` to create the database

### Usage
* Add Team to User:
```php
$user = \Plugins\Auth\Scripts\Auth::user();
$rank = \Plugins\Teams\Models\Team::FindByName("admin");
\Plugins\Teams\Scripts\Ranks::AddTeam($user, $team);
```

* Remove Team from User:
```php
$user = \Plugins\Auth\Scripts\Auth::user();
\Plugins\Teams\Scripts\Teams::RemoveTeam($user);
```

* Check if User is in Team:
```php
$user = \Plugins\Auth\Scripts\Auth::user();
$team = \Plugins\Teams\Models\Team::FindByName("team");
if(\Plugins\Teams\Scripts\Teams::InTeam($user, $team))
{
  //IN TEAM
}else{
  //NOT IN TEAM
}

```
