<?PHP
namespace Catnip;
class Model{
    private $_table;

    public function Init($name)
    {
        $_table = new Table($name);
    }

    public function Insert($columns)
    {
        return $_table->Insert($columns);
    }

    public function Update($columns, $where, $sign, $result)
    {
        return $_table->Update($columns, $where, $sign, $value);
    }

    public function Find($id)
    {
        return $_table->Find($id);
    }

    public function Where($column, $sign, $value)
    {
        return $_table->Where($column, $sign, $value);
    }

    public function First($where, $sign, $value)
    {
        return $_table->First($where, $sign, $value);
    }

    public function All()
    {
        return $_table->All();
    }
}
?>