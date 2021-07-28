# Ranks Plugin for Catnip

### Installation
With Locito:
* Run ``` php locito make:table BBCode ```
* Replace the content in ```database/Tables/BBCodeTable.php``` with the following lines:
  ```php
  <?PHP
  namespace Database\Tables{

      use \Catnip\Table;

      class BBCodesTable{
          public static function build()
          {
              $table = new Table("bbcodes", [
                  "id" => "INT|AUTO_INCREMENT|PRIMARY KEY",
                  "tag" => "VARCHAR(255)|NOT NULL",
                  "bbcode" => "VARCHAR(255)|NOT NULL",
                  "replacement" => "VARCHAR(255)|NOT NULL",
                  "created_at" => "TIMESTAMP|DEFAULT|CURRENT_TIMESTAMP"
              ]);
              $table->Create();
          }

          public static function destroy()
          {
              $table = new Table("bbcodes");
              $table->Drop();
          }
      }
  }
  ?>
  ```
* Run ```php locito make:seeder BBCode```
* Add the following lines to ```database/Tables/BBCodeSeeder.php```:
  ```php
  <?PHP
  namespace Database\Seeders;
  use \Plugins\BBCodes\Models\BBCode;

  class BBCodeSeeder{

      public static function run()
      {
          BBCode::Create([
              'tag' => 'img',
              'bbcode' => '[img={1}]{2}[/img]',
              'replacement' => '<img src="{1}">{2}</img>'
          ]);
      }
  }
  ?>
  ```

* Add those lines before the end of the ```Compile``` function in ```\catnip\View.php``` to extend the Templating System (MAKE A BACKUP!):
```php
//Handle RANKS plugin 
$newcontent = preg_replace("/@hasRank\((.*)\)/", "<?PHP if(\Plugins\Ranks\Scripts\Ranks::UserHasRank(\Plugins\Ranks\Models\Rank::FindByName($1))){?>", $newcontent);
$newcontent = preg_replace("/@endHasRank/", "<?PHP } ?>", $newcontent);


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
