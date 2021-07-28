<?PHP
namespace Plugins\BBCodes\Scripts;

use \Plugins\BBCodes\Models\BBCode;

class BBCodes{
    public static function Replace($string)
    {
        foreach (BBCode::All() as $bbcode) {
            $code = $bbcode->bbcode;
            $rep = $bbcode->replacement;

            $newcontent = preg_replace("/@if\((.*)\)/", "<?PHP if($1){ ?>", $newcontent);
        }
    }

    public static function Add($tag, $bbcode, $replacement)
    {
        $replacement = self::Transform($replacement);
        BBCode::Create([
            'tag' => $tag,
            'bbcode' => $bbcode,
            'replacement' => $replacement
        ]);
    }

    public static function Remove($model)
    {
        $model->Delete();
    }

    private static function Transform($bbcode)
    {
        $bbcode = preg_replace("/\{\$([0-9]{1,})\}/");
    }
}