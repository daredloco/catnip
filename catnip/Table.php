<?PHP
namespace Catnip{
    class Table{
        public $name;
        public $columns = [];
        public $foreigns = [];
        protected $db;

        public function __construct($name, $columns = [], $foreigns = [])
        {
            $this->name = $name;
            $this->columns = $columns;
            $this->foreigns = $foreigns;
            $this->db = new \CatNip\pd0();
        }

        public function Create()
        {
            $cols = "";
            foreach ($this->columns as $column => $info) {
                $info = str_replace("|"," ", $info);
                if($cols == "")
                {
                    $cols = $column.' '.$info;
                }else{
                    $cols .= ', '.$column.' '.$info;
                }
            }
            $foreign = "";
            foreach($this->foreigns as $key => $table)
            {
                $foreign .= ", FOREIGN KEY (".$key.")
                REFERENCES ".$table." (id)
                ON UPDATE RESTRICT ON DELETE CASCADE";           
            }

            $sqlquery = "CREATE TABLE IF NOT EXISTS ".$this->name." (".$cols.$foreign.")  ENGINE=INNODB;";
            $this->db->query($sqlquery);
        }

        public function Drop()
        {
            $sqlquery = "DROP TABLE IF EXISTS ".$this->name.";";
            $this->db->query($sqlquery);
        }

        public function Truncate()
        {
            $sqlquery = "TRUNCATE TABLE ".$this->name.";";
            $this->db->query($sqlquery);
        }

        public function Insert($columns)
        {
            $keys = "";
            $values = "";
            foreach ($columns as $key => $value) {
                if($keys == "")
                {
                    $keys = $key;
                    $values = "'".$value."'";
                }else{
                    $keys .= ', '.$key;
                    $values .= ', '."'".$value."'";
                }
            }
            return $this->db->insert($this->name, $keys, $values);            
        }

        public function Update($columns, $where, $sign, $result)
        {
            $setstr = "";
            foreach ($columns as $key => $value) {
                if($setstr == "")
                {
                    $setstr = $key.'='."'".$value."'";
                }else{
                    $setstr = ', '.$key.'='."'".$value."'";
                }
            }
            return $this->db->update($this->name, $setstr, $where.' '.$sign.' '.$result);
        }

        public function Delete($where, $sign, $result)
        {
            $sqlquery = "DELETE FROM ".$this->name." WHERE ".$where.' '.$sign.' "'.$result.'";';
            $this->db->query($sqlquery);
        }

        public function Count($where = null, $sign = null, $result = null)
        {
            if(is_null($where) || is_null($sign) || is_null($result))
            {
                return $db->count($this->name);
            }
            return $this->db->count($this->name, $where.' '.$sign.' "'.$result.'"');
        }

        public function Exists($where, $sign, $result)
        {
            $data = $this->Where($where, $sign, $result);
            if(count($data) > 0)
            {
                return TRUE;
            }
            return FALSE;
        }

        public function Where($where, $sign, $result)
        {
            $sqlquery = "SELECT * FROM ".$this->name." WHERE ".$where.' '.$sign.' "'.$result.'";';
            return $this->db->query($sqlquery);
        }

        public function All()
        {
            $sqlquery = "SELECT * FROM ".$this->name.";";
            return $this->db->query($sqlquery);
        }

        public function First($where, $sign, $result)
        {
            $sqlquery = "SELECT * FROM ".$this->name." WHERE ".$where.' '.$sign.' "'.$result.'";';
            $sqlresult = $this->db->query($sqlquery);
            if(count($sqlresult) > 0)
            {
                return $sqlresult[0];
            }
            return null;
        }
    }
}