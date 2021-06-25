<?PHP
namespace Plugins\Google;
class Recaptcha{
    public static function Init()
    {
        echo '<script src="https://www.google.com/recaptcha/api.js"></script>';
    }

    public static function Button($text = "Submit")
    {   
        echo '<button class="g-recaptcha" 
        data-sitekey="'.GOOGLE_CAPTCHA_KEY.'" 
        data-callback="onSubmit" 
        data-action="submit">'.$text.'</button>';
    }

    public static function Callback($parentform)
    {
        echo "<script>
        function onSubmit(token) {
          var response = grecaptcha.getResponse();
          const obj = JSON.parse(response);
          if(obj.score > ".\GOOGLE_CAPTCHA_MINSCORE.")
          {
                document.getElementById('".$parentform."').submit();
          }else{
              //DO SOMETHING ELSE IF CHALLENGE PASSED
          }
        }
        </script>";
    }
}
?>