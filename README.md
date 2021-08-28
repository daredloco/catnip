# Catnip Framework (Pre Alpha)
 
### About
The Catnip Framework is a PHP MVC Framework with a focus on simplicity, modularity and a small size.
It's size without plugins and locito (command-line tool) is less than 100kb.

### Dependencies
* PHP 7+
* Composer

### Built-In Functions
* Cache => Add Cache to your projects with just one click and decide wether your want to activate cache for a view or not by code
* Localization => With the builtin LoCa Localization System you can easily localizate your project
* Custom ErrorHandler => Handle any kind of error the way you want.
* FileUploader => Download/Upload/Show Files and their content the easy way
* Locito => This Console application helps you create new Models, Tables, Views and it can update dependencies (even from plugins) automatically. Powered by [Symfony/Console](https://github.com/symfony/console)
* Template System => Our own Template System, helps you create templates without using any line of PHP inside it.
* Validator => Check your requests for datatypes and more

### Plugins (Optional)
* [Auth](https://github.com/daredloco/catnip/tree/main/plugins/Auth) => A plugin that handles login/registration/logout
* [Ranks](https://github.com/daredloco/catnip/tree/main/plugins/Ranks) => A plugin that helps you handle User ranks/permissions
* [Teams](https://github.com/daredloco/catnip/tree/main/plugins/Teams) => A plugin that helps you handle User teams/permissions
* [Google\Analytics](https://github.com/daredloco/catnip/tree/main/plugins/Google) => A plugin that handles interaction with Google\Analytics
* [Google\Recaptcha](https://github.com/daredloco/catnip/tree/main/plugins/Google) => A plugin that handles RecaptchaV3
* [Google\Drive](https://github.com/daredloco/catnip/tree/main/plugins/Google) => A plugin that handles interaction with Google\Drive (work in progress)
* SEO => A plugin that helps you with your SEO (Todo)
* Blog => A plugin that helps you create your own blog (Todo)
* CMS => Content Management System to manage website without (much) coding (Todo)
* Supporter => Support/Ticket System (Todo)

**Warning**: Plugins may need other dependencies! Call ``` php locito plugins:update ``` to install the dependencies and check their licenses!

### Usage
[Manual](https://github.com/daredloco/catnip/tree/main/Manual.md)

### License
http://creativecommons.org/licenses/by-nc-nd/4.0/

**If you want to use the framework commercially visit https://www.helvetiapps.com/products#catnip for more informations**
