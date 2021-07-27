<?PHP
namespace Catnip;

use \Catnip\Utils\Str;

class Validator{
    public static function Validate($values)
    {
        if(!is_array($values))
        {
            $valarr = [$values];
            $values = $valarr;
        }
        foreach ($values as $value => $args) {
            if(!validateValue($value, $args))
            {
                return false;
            }
        }
        return true;
    }

    private function validateValue($value, $args)
    {
        //Types: numeric, integer, double, float, long, array, bool, string, email, ip, url, domain, password (needs upper/lower/number min:8, max:32)
        //Conditions: nullable
        $argsarr = explode('|', $args);
        $isNullable = false;
        $isArray = false;

        foreach($argsarr as $arg)
        {
            //TYPES
            switch($arg)
            {
                case "array":
                    if(is_array($value))
                    {
                        $isArray = true;
                    }
                break;
                case "numeric":
                    if(is_array($value))
                    {
                        foreach($value as $val)
                        { 
                            if(!is_numeric($val))
                            {
                                return false;
                            }
                        }
                    }else{
                        if(!is_numeric($value))
                        {
                            return false;
                        }
                    }
                break;
                case "integer":
                    if(is_array($value))
                    {
                        foreach($value as $val)
                        {
                            if(!is_int($val))
                            {
                                return false;
                            }
                        }
                    }else{
                        if(!is_int($value))
                        {
                            return false;
                        }
                    }
                break;
                case "double":
                    if(is_array($value))
                    {
                        foreach($value as $val)
                        {
                            if(!is_double($val))
                            {
                                return false;
                            }
                        }
                    }else{
                        if(!is_double($value))
                        {
                            return false;
                        }
                    }
                break;
                case "float":
                    if(is_array($value))
                    {
                        foreach($value as $val)
                        { 
                            if(!is_float($val))
                            {
                                return false;
                            }
                        }
                    }else{ 
                        if(!is_float($value))
                        {
                            return false;
                        }
                    }
                break;
                case "long":
                    if(is_array($value))
                    {
                        foreach($value as $val)
                        {
                            if(!is_long($val))
                            {
                                return false;
                            }
                        }
                    }else{
                        if(!is_long($value))
                        {
                            return false;
                        }
                    }
                break;
                case "bool":
                    if(is_array($value))
                    {
                        foreach($value as $val)
                        {
                            if(!is_bool($val))
                            {
                                return false;
                            }
                        }
                    }else{
                        if(!is_bool($value))
                        {
                            return false;
                        }
                    }
                break;
                case "string":
                    if(is_array($value))
                    {
                        foreach($value as $val)
                        {
                            if(!is_string($val))
                            {
                                return false;
                            }
                        }
                    }else{
                        if(!is_string($value))
                        {
                            return false;
                        }
                    }
                break;
                case "email":
                    if(is_array($value))
                    {
                        if (!filter_var_array($value, FILTER_VALIDATE_EMAIL)) {
                            return false;
                        }
                    }else{
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            return false;
                        }
                    }
                break;
                case "ip":
                    if(is_array($value))
                    {
                        if(!filter_var_array($value, FILTER_VALIDATE_IP)){
                            return false;
                        }
                    }else{
                        if(!filter_var($value, FILTER_VALIDATE_IP)){
                            return false;
                        }
                    }
                break;
                case "url":
                    if(is_array($value))
                    {
                        if(!filter_var_array($value, FILTER_VALIDATE_URL))
                        {
                            return false;
                        }
                    }else{
                        if(!filter_var($value, FILTER_VALIDATE_URL))
                        {
                            return false;
                        }
                    }
                break;
                case "domain":
                    if(is_array($value))
                    {
                        if(!filter_var_array($value, FILTER_VALIDATE_DOMAIN))
                        {
                            return false;
                        }
                    }else{
                        if(!filter_var($value, FILTER_VALIDATE_DOMAIN))
                        {
                            return false;
                        }
                    }
                break;
                case "password":
                    if(is_array($value))
                    {
                        foreach($value as $pass)
                        {
                            $uppercase = preg_match('@[A-Z]@', $pass);
                            $lowercase = preg_match('@[a-z]@', $pass);
                            $number    = preg_match('@[0-9]@', $pass);
                            $length    = preg_match("@^.{8,32}$@" , $pass);
                            if(!$uppercase || !$lowercase || !$number ||  !$length  ) {
                                return false;
                            }
                        }
                    }else{
                        $uppercase = preg_match('@[A-Z]@', $value);
                        $lowercase = preg_match('@[a-z]@', $value);
                        $number    = preg_match('@[0-9]@', $value);
                        $length    = preg_match("@^.{8,32}$@" , $value);
                        if(!$uppercase || !$lowercase || !$number ||  !$length  ) {
                            return false;
                        }
                    }
                break;
            }
            
            //CONDITIONS
            switch($arg)
            {
                case "nullable":
                    $isNullable = true;
                break;
                case "unsigned":
                    if(is_numeric($value))
                    {
                        if($value < 0)
                        {
                            return false;
                        }
                    }
                break;
            }

            //Check if the value is smaller than the minimum value
            if(Str::StartsWith("min:", $arg))
            {
                $minval = (int)str_replace("min:", "", $arg);
                if(is_numeric($value))
                {
                    if($value < $minval)
                    {
                        return false;
                    }
                }
                elseif(is_array($value))
                {
                    if(count($value) < $minval)
                    {
                        return false;
                    }
                }
                else{
                    if(strlen($value) < $minval)
                    {
                        return false;
                    }
                }
            }

            //Check if the value is bigger than the maximum value
            if(Str::EndsWith("max:", $arg))
            {
                $maxval = (int)str_replace("max:", "", $arg);
                if(is_numeric($value))
                {
                    if($value > $minval)
                    {
                        return false;
                    }
                }
                elseif(is_array($value))
                {
                    if(count($value) > $minval)
                    {
                        return false;
                    }
                }
                else{
                    if(strlen($value) > $minval)
                    {
                        return false;
                    }
                }
            }
        }

        //Returns false if isnt nullable but is null
        if(!$isNullable)
        {
            if(is_null($value))
            {
                return false;
            }
        }

        //Returns false if isnt array but is array
        if(!$isArray)
        {
            if(is_array($value))
            {
                return false;
            }
        }

        return true;
    }
}