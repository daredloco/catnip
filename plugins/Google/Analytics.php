<?PHP
namespace Plugins\Google;
class Analytics{
    public static function GTag()
    {
       echo '<!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id='.GOOGLE_MEASUREMENT_ID.'"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){window.dataLayer.push(arguments);}
        gtag("js", new Date());

        gtag("config", '.GOOGLE_MEASUREMENT_ID.');
        </script>';
    }

    public static function Event($action, $category = "", $label = "", int $value = 0, bool $noninteraction = false, bool $withTags = false)
    {
        if($withTags)
        {
            echo "<script>";
        }
        echo "gtag('event', '".$action."', {
        'event_category': '".$category."',
        'event_label': '".$label."',
        'value': '".$value."',
        'non_interaction': true;})";
        if($withTags)
        {
            echo "</script>";
        }
    }

    public static function ScreenView($screenname, $appname, bool $withTags = false)
    {
        if($withTags)
        {
            echo "<script>";
        }
        echo "gtag('event', 'screen_view', {
        'app_name': '".$appname."',
        'screen_name' : '".$screenname."'
        });";
        
        if($withTags)
        {
            echo "</script>";
        }
    }

    public static function Exception($exceptiondetails, bool $fatal = false, bool $withTags = false)
    {   
        if($withTags)
        {
            echo "<script>";
        }
        echo "gtag('event', 'exception', {
        'description': '".$exceptiondetails."',
        'fatal': ".$fatal."});";
        
        if($withTags)
        {
            echo "</script>";
        }
    }
}
?>