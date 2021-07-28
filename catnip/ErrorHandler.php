<?PHP
namespace Catnip;

use \Catnip\Debugger;

class ErrorHandler{
    public static function NotFound()
    {
        Debugger::Info("Page not found on URL ".(($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        include('../errorpages/404.php');
    }

    public static function MethodNotAllowed()
    {
        Debugger::Info("Method not allowed on URL ".(($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
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
        Debugger::Exception("Error: ".$msg."\nSeverity: ".$severity."\nFile: ".$file."\nLine: ".$line."\n\n");
        print '<strong>Error</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function Warning($severity, $msg, $file, $line)
    {
        
        Debugger::Exception("Warning: ".$msg."\nSeverity: ".$severity."\nFile: ".$file."\nLine: ".$line."\n\n");
        print '<strong>Warning</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function Parse($severity, $msg, $file, $line)
    {
        Debugger::Exception("Parse: ".$msg."\nSeverity: ".$severity."\nFile: ".$file."\nLine: ".$line."\n\n");
        
        print '<strong>Parse</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function Notice($severity, $msg, $file, $line)
    {
        Debugger::Exception("Notice: ".$msg."\nSeverity: ".$severity."\nFile: ".$file."\nLine: ".$line."\n\n");
        
        print '<strong>Notice</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function CoreError($severity, $msg, $file, $line)
    {
        Debugger::Exception("Core Error: ".$msg."\nSeverity: ".$severity."\nFile: ".$file."\nLine: ".$line."\n\n");
        
        print '<strong>Core Error</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function CoreWarning($severity, $msg, $file, $line)
    {
        Debugger::Exception("Core Warning: ".$msg."\nSeverity: ".$severity."\nFile: ".$file."\nLine: ".$line."\n\n");
        
        print '<strong>Core Warning</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function CompileError($severity, $msg, $file, $line)
    {
        Debugger::Exception("Compile Error: ".$msg."\nSeverity: ".$severity."\nFile: ".$file."\nLine: ".$line."\n\n");
        
        print '<strong>Compile Error</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function CompileWarning($severity, $msg, $file, $line)
    {
        Debugger::Exception("Compile Warning: ".$msg."\nSeverity: ".$severity."\nFile: ".$file."\nLine: ".$line."\n\n");
        
        print '<strong>Compile Warning</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function UserError($severity, $msg, $file, $line)
    {
        Debugger::Exception("User Error: ".$msg."\nSeverity: ".$severity."\nFile: ".$file."\nLine: ".$line."\n\n");
        
        print '<strong>User Error</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function UserWarning($severity, $msg, $file, $line)
    {
        Debugger::Exception("User Warning: ".$msg."\nSeverity: ".$severity."\nFile: ".$file."\nLine: ".$line."\n\n");
        
        print '<strong>User Warning</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function UserNotice($severity, $msg, $file, $line)
    {
        Debugger::Exception("User Notice: ".$msg."\nSeverity: ".$severity."\nFile: ".$file."\nLine: ".$line."\n\n");
        
        print '<strong>User Notice</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function Strict($severity, $msg, $file, $line)
    {
        Debugger::Exception("Strict: ".$msg."\nSeverity: ".$severity."\nFile: ".$file."\nLine: ".$line."\n\n");
        
        print '<strong>Strict</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function Recoverable($severity, $msg, $file, $line)
    {
        Debugger::Exception("Recoverable: ".$msg."\nSeverity: ".$severity."\nFile: ".$file."\nLine: ".$line."\n\n");
        
        print '<strong>Recoverable</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function Deprecated($severity, $msg, $file, $line)
    {
        Debugger::Exception("Deprecated: ".$msg."\nSeverity: ".$severity."\nFile: ".$file."\nLine: ".$line."\n\n");
        
        print '<strong>Deprecated</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }

    private static function UserDeprecated($severity, $msg, $file, $line)
    {
        Debugger::Exception("User Deprecated: ".$msg."\nSeverity: ".$severity."\nFile: ".$file."\nLine: ".$line."\n\n");
        
        print '<strong>User Deprecated</strong><br>\n
        Severity: '.$severity.'<br>
        Message: '.$msg.'<br>
        File: '.$file.'<br>
        Line: '.$line;
    }
}
?>