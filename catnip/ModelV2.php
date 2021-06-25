<?PHP
namespace Catnip;

class ModelV2{
    protected static $table;
    protected static $tablename;

    public static function Find($id)
    {
        self::Init();
        $row = self::$table->First('id', '=', $id);
        if(is_null($row))
        {
            return null;
        }
        return self::MakeObject($row);
    }

    public static function Where($where, $sign, $value)
    {
        self::Init();
        $row = self::$table->Where($where, $sign, $value);
        if(is_null($row))
        {
            return null;
        }
        return self::MakeObject($row);
    }

    public static function All()
    {
        self::Init();
        $lst = [];

        foreach (self::$table->All() as $method) {
            $obj = self::MakeObject($method);
            array_push($lst, $obj);
        }
        return $lst;
    }

    private static function Init()
    {
        if(!is_null(self::$table))
        {
            return;
        }
        self::$table = new \Catnip\Table(static::$tablename);
    }

    //HELPER FUNCTIONS
    private static function MakeObject($array)
    {
        $model = new ModelV2();
        foreach ($array as $key => $value) {
        $model->{$key} = $value;   
        }
        $model->TestMe = function(){ return 'Hello World!';};

        return $model;
    }

    public function __call($closure, $args)
    {
        return call_user_func_array($this->{$closure}->bindTo($this),$args);
    }

    public function __toString()
    {
        return call_user_func($this->{"__toString"}->bindTo($this));
    }
}
?>