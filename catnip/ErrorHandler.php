<?PHP
namespace Catnip;
class ErrorHandler{
    public static function NotFound()
    {
        include('../errorpages/404.php');
    }

    public static function MethodNotAllowed()
    {
        include('../errorpages/405.php');
    }

    public static function Global($err_severity, $err_msg, $err_file, $err_line)
    {
        if(!DEBUG_MODE){ return false; }
        if (0 === error_reporting()) { return false;}
        switch($err_severity)
        {
            case E_ERROR:               Error($err_severity, $err_msg, $err_file, $err_line);
            case E_WARNING:             Warning($err_severity, $err_msg, $err_file, $err_line);
            case E_PARSE:               Parse($err_severity, $err_msg, $err_file, $err_line);
            case E_NOTICE:              Notice($err_severity, $err_msg, $err_file, $err_line);
            case E_CORE_ERROR:          CoreError($err_severity, $err_msg, $err_file, $err_line);
            case E_CORE_WARNING:        CoreWarning($err_severity, $err_msg, $err_file, $err_line);
            case E_COMPILE_ERROR:       CompileError($err_severity, $err_msg, $err_file, $err_line);
            case E_COMPILE_WARNING:     CompileWarning($err_severity, $err_msg, $err_file, $err_line);
            case E_USER_ERROR:          UserError($err_severity, $err_msg, $err_file, $err_line);
            case E_USER_WARNING:        UserWarning($err_severity, $err_msg, $err_file, $err_line);
            case E_USER_NOTICE:         UserNotice($err_severity, $err_msg, $err_file, $err_line);
            case E_STRICT:              Strict($err_severity, $err_msg, $err_file, $err_line);
            case E_RECOVERABLE_ERROR:   Recoverable($err_severity, $err_msg, $err_file, $err_line);
            case E_DEPRECATED:          Deprecated($err_severity, $err_msg, $err_file, $err_line);
            case E_USER_DEPRECATED:     UserDeprecated($err_severity, $err_msg, $err_file, $err_line);
        }
        exit();
    }

    private static function Error($severity, $msg, $file, $line)
    {
        print '<strong>Error</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function Warning($severity, $msg, $file, $line)
    {
        print '<strong>Warning</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function Parse($severity, $msg, $file, $line)
    {
        print '<strong>Parse</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function Notice($severity, $msg, $file, $line)
    {
        print '<strong>Notice</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function CoreError($severity, $msg, $file, $line)
    {
        print '<strong>Core Error</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function CoreWarning($severity, $msg, $file, $line)
    {
        print '<strong>Core Warning</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function CompileError($severity, $msg, $file, $line)
    {
        print '<strong>Compile Error</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function CompileWarning($severity, $msg, $file, $line)
    {
        print '<strong>Compile Warning</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function UserError($severity, $msg, $file, $line)
    {
        print '<strong>User Error</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function UserWarning($severity, $msg, $file, $line)
    {
        print '<strong>User Warning</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function UserNotice($severity, $msg, $file, $line)
    {
        print '<strong>User Notice</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function Strict($severity, $msg, $file, $line)
    {
        print '<strong>Strict</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function Recoverable($severity, $msg, $file, $line)
    {
        print '<strong>Recoverable</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function Deprecated($severity, $msg, $file, $line)
    {
        print '<strong>Deprecated</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function UserDeprecated($severity, $msg, $file, $line)
    {
        print '<strong>User Deprecated</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }
}
?>