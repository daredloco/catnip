# Google Plugins for Catnip

## Drive

### Installation
TODO


## Analytics

### Installation
* OPTIONAL Add those lines before the end of the ```Compile``` function in ```\catnip\View.php``` to extend the Templating System (MAKE A BACKUP!):
```php
$newcontent = preg_replace("/@GTag/", "<?PHP \Plugins\Google\Analytics::GTag(); ?>", $newcontent);
$newcontent = preg_replace("/@GEvent\((.*),(.*),(.*),(.*),(.*),(.*)\)/", "<?PHP \Plugins\Google\Analytics::Event($1,$2,$3,$4,$5,$6) ?>", $newcontent);
$newcontent = preg_replace("/@GView\((.*),(.*),(.*)\)/", "<?PHP \Plugins\Google\Analytics::ScreenView($1,$2,$3) ?>", $newcontent);
$newcontent = preg_replace("/@GException\((.*),(.*),(.*)\)/", "<?PHP \Plugins\Google\Analytics::Exception($1,$2,$3) ?>", $newcontent);
```

### Usage
* Add this code inside the head of your View to activate Google Analytics:
```php
<head>
\Plugins\Google\Analytics::GTag();
</head>
```

* Use ```\Plugins\Google\Analytics::Event($action, $category = "", $label = "", int $value = 0, bool $noninteraction = false, bool $withTags = false)``` to catch Events:
```php
\Plugins\Google\Analytics::Event("did_test", "test_category", "test123", 42, true, true);
```

* Use ```\Plugins\Google\Analytics::ScreenView($screenname, $appname, bool $withTags = false)``` to catch ScreenViews:
```php
\Plugins\Google\Analytics::ScreenView("home_screen", "test_app", false); //Inside a <script></script> we can set $withTags to false
```

* Use ```\Plugins\Google\Analytics::Exception($exceptiondetails, bool $fatal = false, bool $withTags = false)``` to catch Exceptions:
```php
<script>
try{

}catch(ex)
{
{{ \Plugins\Google\Analytics::Exception(ex, false, false) }}
}
</script>
```