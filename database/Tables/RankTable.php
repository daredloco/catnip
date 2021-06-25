<?PHP
#############################################################################################
#                                     IMPORTANT                                                 
#                                                                                              
#          Run "php locito db:build" after editing the Table to update the database!
#          
#############################################################################################

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