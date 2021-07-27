# Manual

## Locito

Locito is a commandline tool for the framework.

### Usage

Install Frameworks dependencies for the first time
```
php locito app:install
```

Update Frameworks dependencies
```
php locito app:update
```

Update Plugins dependencies
```
php locito plugins:update
```

Clear cache and temp folders
```
php locito clear:all
```

Clear cache folder
```
php locito clear:cache
```

Clear temp folder
```
php locito clear:temp
```

Build database (You will need to create the table first!)
```
php locito db:build
```

Make Controller, Model, Seeder and Table (If you write it in uppercase, the table will be written in lowercase automatically!)
```
php locito make:all Name
```

Make Controller
```
php locito make:controller Name
```

Make Model
```
php locito make:model Name
```

Make Seeder
```
php locito make:seeder Name
```

Make Table
```
php locito make:table Name
```

Make View
```
php locito make:view Name
```

Make Localization (key is en for example, english name is the name in english, local name is the name in the local language)
```
php locito make:loca Key EnglishName LocalName
```


## Validator

With the Validator class you can check for datatypes and more.

### Usage

Import class
```php
use \Catnip\Validator;
```

Check for string
```php
$isValid = Validator::Validate(['value' => 'string']); //Returns true if its string, false if not
```

Check for numeric
```php
$isValid = Validator::Validate([1 => 'numeric']); //Returns true if its string, false if not
```

Check for integer
```php
$isValid = Validator::Validate([1 => 'integer']); //Returns true if its string, false if not
```

Check for double
```php
$isValid = Validator::Validate([2.5 => 'double']); //Returns true if its string, false if not
```

Check for float
```php
$isValid = Validator::Validate([2.5 => 'float']); //Returns true if its string, false if not
```

Check for long
```php
$isValid = Validator::Validate([1 => 'long']); //Returns true if its string, false if not
```

Check for boolean
```php
$isValid = Validator::Validate([true => 'bool']); //Returns true if its string, false if not
```

Check for array
```php
$isValid = Validator::Validate([['value'] => 'array']); //Returns true if its string, false if not
```

Check for email
```php
$isValid = Validator::Validate(['email@domain.tld' => 'email']); //Returns true if its string, false if not
```

Check for domain
```php
$isValid = Validator::Validate(['localhost' => 'domain']); //Returns true if its string, false if not
```

Check for IP
```php
$isValid = Validator::Validate(['127.0.0.1' => 'ip']); //Returns true if its string, false if not
```

Check for Url
```php
$isValid = Validator::Validate(['https://www.rowa-digital.ch' => 'url']); //Returns true if its string, false if not
```

Check for password (Needs to be at least 8 chars long and max 32 chars. Needs to contain uppercase, lowercase and numbers)
```php
$isValid = Validator::Validate(['Password11' => 'password']); //Returns true if its string, false if not
```

Check if value is nullable (If nullable is not set, but the value is null the validator would return false!)
```php
$isValid = Validator::Validate([null => 'string|nullable']);
```

Check if value is unsigned (Needs to be a number or will be ignored)
```php
$isValid = Validator::Validate([-1 => 'integer|unsigned']);
```

Check for minimum value (for string is string length, for array is array size)
```php
$isValid = Validator::Validate([['a','b','c'] => 'array|min:3']);
```

Check for maximum value (for string is string length, for array is array size)
```php
$isValid = Validator::Validate([['a','b','c'] => 'array|max:4']);
```

Check if value starts with another value (needs to be a string or will be ignored)
```php
$isValid = Validator::Validate(['startHere' => 'string|starts:start']);
```

Check if value ends with another value (needs to be a string or will be ignored)
```php
$isValid = Validator::Validate(['hereitEnds' => 'string|ends:Ends']);
```

### Hints
You can combine multiple checks together. For example:
```php
$isValid = Validator::Validate(['Hello!' => 'string|min:2|max:5']); //Would return false if string length is smaller than 2 and bigger than 5
$isValid = Validator::Validate([25 => 'integer|unsigned|min:20|max:25']); //Would return false if integer would be below 0, smaller than 20 or bigger than 25
$isValid = Validator::Validate([['hello', 'world'] => 'array|min:2']); //Would return false if array would have less than 2 items
```

You can check an array for its content. For example:
```php
$isValid = Validator::Validate([['test'] => 'array|integer']); //Would return false, because test is a string and not an integer
$isValid = Validator::Validate([['test', 1] => 'array|integer']); //Would return false, because test is a string and not an integer

$isValid = Validator::Validate([[1] => 'array|integer']); //Would return true, because 1 is an integer
```

You can check multiple values at once. For example:
```php
$value1 = 'test';
$value2 = 2;

$isValid = Validator::Validate([
    $value1 => 'string',
    $value2 => 'integer', 
]);
```