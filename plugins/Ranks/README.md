# Ranks Plugin for Catnip

### Requirements

To use all functions in this plugin you'll need the Auth plugin or create an own 'users' table with a rank row as integer!

### Installation
With Locito:
* Run ``` php locito make:table Rank ```
* Replace the content in ```database/Tables/RankTable.php``` with the following lines:
  ```php
  <?PHP
  namespace Database\Tables{

      use \Catnip\Table;

      class RankTable{
          public static function build()
          {
              $table = new Table("ranks", [
                  "id" => "INT|AUTO_INCREMENT|PRIMARY KEY",
                  "name" => "VARCHAR(255)|NOT NULL",
                  "score" => "INT|NOT NULL",
                  "created_at" => "TIMESTAMP|DEFAULT|CURRENT_TIMESTAMP"
              ]);
              $table->Create();
          }

          public static function destroy()
          {
              $table = new Table("ranks");
              $table->Drop();
          }
      }
  }
  ?>
  ```
* Run ```php locito make:seeder Rank```
* Add the following lines to ```database/Tables/RankSeeder.php```:
  ```php
  <?PHP
  namespace Database\Seeders;
  use \Plugins\Ranks\Models\Rank;

  class RankSeeder{

      public static function run()
      {
          Rank::Create([
              'name' => 'user',
              'score' => 1
          ]);

          Rank::Create([
              'name' => 'admin',
              'score' => 2 //Higher Rank has bigger score
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
                "rank" => "INT" //ADD THIS LINE
            ],
            ['rank' => 'ranks'] //ADD THIS LINE TO MAKE 'rank' a foreign key
  ```

* Add those lines before the end of the ```Compile``` function in ```\catnip\View.php``` to extend the Templating System (MAKE A BACKUP!):
```php
//Handle RANKS plugin 
$newcontent = preg_replace("/@hasRank\((.*)\)/", "<?PHP if(\Plugins\Ranks\Scripts\Ranks::UserHasRank(\Plugins\Ranks\Models\Rank::FindByName($1))){?>", $newcontent);
$newcontent = preg_replace("/@endHasRank/", "<?PHP } ?>", $newcontent);

$newcontent = preg_replace("/@hasHigherRank\((.*)\)/", "<?PHP if(\Plugins\Ranks\Scripts\Ranks::UserHasHigherRank(\Plugins\Ranks\Models\Rank::FindByName($1))){?>", $newcontent);
$newcontent = preg_replace("/@endHasHigherRank/", "<?PHP } ?>", $newcontent);

$newcontent = preg_replace("/@hasHigherScore\((.*)\)/", "<?PHP if(\Plugins\Ranks\Scripts\Ranks::UserHasHigherScore($1)){?>", $newcontent);
$newcontent = preg_replace("/@endHasHigherScore/", "<?PHP } ?>", $newcontent);


//ADD BEFORE THIS LINE
if($cache)
{
        $newcontent .= "<?PHP \\Catnip\\Cache::CacheEnd(); ?>";
}
```

* Run ```php locito db:build --fresh --seed``` to create the database

### Usage
* Add Rank to User:
```php
$user = \Plugins\Auth\Scripts\Auth::user();
$rank = \Plugins\Ranks\Models\Rank::FindByName("admin");
\Plugins\Ranks\Scripts\Ranks::AddRank($user, $rank);
```

* Remove Rank from User:
```php
$user = \Plugins\Auth\Scripts\Auth::user();
\Plugins\Ranks\Scripts\Ranks::RemoveRank($user);
```

* Check if User has certain rank:
```php
$user = \Plugins\Auth\Scripts\Auth::user();
$rank = \Plugins\Ranks\Models\Rank::FindByName("admin");
if(\Plugins\Ranks\Scripts\Ranks::HasRank($user, $rank))
{
  //HAS RANK
}else{
  //DOENST HAVE RANK
}

```

* Check if User has a higher rank:
```php
$user = \Plugins\Auth\Scripts\Auth::user();
$rank = \Plugins\Ranks\Models\Rank::FindByName("admin");
if(\Plugins\Ranks\Scripts\Ranks::HasHigherRank($user, $rank))
{
  //HAS HIGHER RANK
}else{
  //DOENST HAVE HIGHER RANK
}
```

* Check if User has higher score:
```php
$user = \Plugins\Auth\Scripts\Auth::user();
$score = 2;
if(\Plugins\Ranks\Scripts\Ranks::HasHigherScore($user, $rank))
{
  //HAS HIGHER RANK
}else{
  //DOENST HAVE HIGHER RANK
}
```

* Check if loggedin User has certain rank:
```php
$rank = \Plugins\Ranks\Models\Rank::FindByName("admin");
if(\Plugins\Ranks\Scripts\Ranks::UserHasRank($rank))
{
  //HAS HIGHER RANK
}else{
  //DOESNT HAVE HIGHER RANK
}
```

* Check if loggedin User has higher rank:
```php
$rank = \Plugins\Ranks\Models\Rank::FindByName("admin");
if(\Plugins\Ranks\Scripts\Ranks::UserHasHigherRank($rank))
{
  //HAS RANK
}else{
  //DOESNT HAVE RANK
}
```

* Check if loggedin User has higher score:
```php
$score = 2;
if(\Plugins\Ranks\Scripts\Ranks::UserHasHigherScore($score))
{
  //HAS RANK
}else{
  //DOESNT HAVE RANK
}
```
