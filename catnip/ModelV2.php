<?PHP
namespace Catnip;

class ModelV2{
    protected static $table;
    protected static $tablename;
    protected static $fillables = [];

    public static function Create($columns)
    {
        self::Init();
        self::$table->Insert($columns);
    }

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
        $model->id = $array["id"];
        foreach (static::$fillables as $fillable)
        {
            if(isset($array[$fillable]))
            {
                $model->{$fillable} = $array[$fillable];
            }
        }
        $model->TestMe = function() use ($model){ return 'Hello '.$model->name.'!';};
        $model->Update = function($changes) use ($model){ self::$table->Update($changes, 'id', '=', $model->id); };
        $model->Delete = function() use ($model){ self::$table->Delete('id', '=', $model->id);};
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