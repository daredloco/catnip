<?PHP
namespace Catnip\Helpers;
class FileHandler{
    //DATA TRANSFER
    public static function UploadFile($file, $destination, bool $override = false, bool $isPrivate = false)
    {
        //SETS THE TARGET_DIR FOR EITHER A PRIVATE OR PUBLIC UPLOAD
        $target_dir = FS_DIRECTORY;
        if($isPrivate)
        {
            $target_dir = FS_PRIVATEDIRECTORY;
        }

        $target_file = $target_dir.$destination;

        //CHECKS IF FILE ALREADY EXISTS AND IF OVERRIDE IS SET TO TRUE
        if (file_exists($target_file) && !$override) {
            return false;
        }

        //CHECKS IF FILESIZE IS BIGGER THAN MAXSIZE AND IF MAXSIZE IS NOT 0
        if($file["size"] > FS_MAXSIZE && FS_MAXSIZE != 0)
        {
            return false;
        }

        //UPLOAD FILE TO TARGET DIRECTORY
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            //returns the target filename if successful
            return $target_file;
        } else {
            return false;
        }
    }

    public static function DownloadFile($location, bool $isPrivate = false)
    {
        $target_dir = FS_DIRECTORY;
        if($isPrivate)
        {
            $target_dir = FS_PRIVATEDIRECTORY;
        }
        $target_file = $target_dir.$location;

        ob_clean();
        echo FileBytes($location, $isPrivate);
    }

    //DATA HANDLING
    public static function FileBytes($location, bool $isPrivate = false)
    {
        $target_dir = FS_DIRECTORY;
        if($isPrivate)
        {
            $target_dir = FS_PRIVATEDIRECTORY;
        }
        $target_file = $target_dir.$location;

        $fhandle = fopen($target_file, "rb");
        $fcontent = fread($fhandle, filesize($target_file));
        fclose($fhandle);

        return $fcontent;
    }

    public static function FileString($location, bool $isPrivate = false)
    {
        $target_dir = FS_DIRECTORY;
        if($isPrivate)
        {
            $target_dir = FS_PRIVATEDIRECTORY;
        }
        $target_file = $target_dir.$location;

        return file_get_contents($target_file);
    }

    public static function DeleteFile($location, bool $isPrivate = false)
    {
        $target_dir = FS_DIRECTORY;
        if($isPrivate)
        {
            $target_dir = FS_PRIVATEDIRECTORY;
        }
        $target_file = $target_dir.$location;

        return unlink($target_file);
    }

    public static function Exists($location, bool $isPrivate = false)
    {
        $target_dir = FS_DIRECTORY;
        if($isPrivate)
        {
            $target_dir = FS_PRIVATEDIRECTORY;
        }
        $target_file = $target_dir.$location;
        return file_exists($target_file);
    }

    public static function IsImage($filename)
    {
        $check = getimagesize($filename);
        if($check !== false) {
          return true;
        }
        return false;
    }
}
?>