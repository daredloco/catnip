<?PHP
namespace Database\Tables{
    class UserTable{
        public static function build()
        {
            $table = new \Catnip\Table("users", [
                "id" => "INT|AUTO_INCREMENT|PRIMARY KEY",
                "name" => "VARCHAR(255)|NOT NULL",
                "password" => "VARCHAR(255)|NOT NULL",
                "email" => "VARCHAR(255)|NOT NULL",
                "created_at" => "TIMESTAMP|DEFAULT|CURRENT_TIMESTAMP",
                "rank" => "INT",
                "team" => "INT"
            ],
            ['rank' => 'ranks', 'team' => 'teams']);
            $table->Create();
        }

        public static function destroy()
        {
            $table = new \Catnip\Table("users");
            $table->Drop();
        }
    }
}
?>