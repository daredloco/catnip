<?PHP
  namespace Database\Tables{

      use \Catnip\Table;

      class TeamTable{
          public static function build()
          {
              $table = new Table("teams", [
                  "id" => "INT|AUTO_INCREMENT|PRIMARY KEY",
                  "name" => "VARCHAR(255)|NOT NULL",
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