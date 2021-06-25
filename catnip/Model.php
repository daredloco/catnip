<?PHP
namespace Catnip;

class Model{
    protected static $table;
    protected static $tablename;
    protected static $fillables = [];

    public static function Create($columns)
    {
        static::Init();
        static::$table->Insert($columns);
    }

    public static function Find($id)
    {
        static::Init();
        $row = static::$table->First('id', '=', $id);
        if(is_null($row))
        {
            return null;
        }
        return static::MakeObject($row);
    }

    public static function First($where, $sign, $value)
    {
        static::Init();
        $row = static::$table->First($where, $sign, $value);
        if(is_null($row))
        {
            return null;
        }
        return static::MakeObject($row);
    }

    public static function Where($where, $sign, $value)
    {
        static::Init();
        $row = static::$table->Where($where, $sign, $value);
        if(is_null($row))
        {
            return null;
        }
        return static::MakeObject($row);
    }

    public static function All()
    {
        static::Init();
        $lst = [];

        foreach (static::$table->All() as $method) {
            $obj = static::MakeObject($method);
            array_push($lst, $obj);
        }
        return $lst;
    }

    public static function Exists($where, $sign, $value)
    {
        static::Init();
        return static::$table->Exists($where, $sign, $value);
    }

    public static function Count($where = null, $sign = null, $value = null)
    {
        static::Init();
        return static::$table->Count($where, $sign, $value);
    }

    //PRIVATE FUNCTION
    private static function Init()
    {
        if(!is_null(static::$table))
        {
            return;
        }
        static::$table = new \Catnip\Table(static::$tablename);
    }

    //HELPER FUNCTIONS
    private static function MakeObject($array)
    {
        $model = new Model();
        $model->id = $array["id"];
        foreach (static::$fillables as $fillable)
        {
            if(isset($array[$fillable]))
            {
                $model->{$fillable} = $array[$fillable];
            }
        }
        $model->TestMe = function() use ($model){ return 'Hello '.$model->name.'!';};
        $model->Update = function($changes) use ($model){ static::$table->Update($changes, 'id', '=', $model->id); };
        $model->Delete = function() use ($model){ static::$table->Delete('id', '=', $model->id);};
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