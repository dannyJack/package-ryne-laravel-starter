<h1>Laravel starter (ryne/laravel-starter)</h1>

> Version 1.0

Laravel starter comes with helpful methods in making laravel projects

## Installation

download the package via composer

`composer require ryne/laravel-starter`

## Files, Classes and Methods

### Files

* DBHelper.php - Database migration helper class
* Helpers.php - Global methods
* L0g.php - Custom message logs, uses the original laravel logging class \Log::class, this only helps the logging error to be arrange with second parameter as array

### Classes

* DBHelper::class
* L0g::class

to use must call or use the class full path itself by:

```
\Ryne\LaravelStarter\DBHelper
\Ryne\LaravelStarter\L0g
```

or register the class in the app.php configuration in the aliases section to easily access its methods

```
'aliases' => Facade::defaultAliases()->merge([
    'DBHelper' => Ryne\LaravelStarter\DBHelper,
    'L0g' => Ryne\LaravelStarter\L0g,
])->toArray(),
```

### Methods

#### ***DBHelper::class

* keyDelete (DBHelper::keyDelete) - static method, use to delete foreign keys in the migration whenever rolling back some migration or simply removing existing foreign keys.

Parameters:

\- String $tableName (required) - table of the foreign keys to be deleted

\- String $key (required) - key name to be deleted

Return: void

Sample usage:

`DBHelper::keyDelete('user_numbers', 'user_numbers_use_id_foreign');`

#### ***L0g::class

* info (L0g::info) - static method, use to make an information log in the storage folder, it uses the laravel \Log::class to output its log while this customize its output message

Parameter:

\- String $message - message to be log

\- ...$params - will accept arrays and string as its value as an additional information about the log

Return: void

Sample usage:

`\L0g::info('test log', ['data' => 'additional data']);`

* error (L0g::info) - static method, use to make an error log in the storage folder, it uses the laravel \Log::class to output its log while this customize its output message

Parameter:

\- String $message - message to be log

\- ...$params - will accept arrays and string as its value as an additional information about the log

Return: void

Sample usage:

`\L0g::error('test log', ['data' => 'additional data']);`

Sample output:

```
[2022-04-10 03:01:21] local.ERROR: ***XController.php@xmethod:11***
Message: "test log"
| data: additional data

File trace:
	file:
		/var/www/dc/vendor/ryne/laravel-starter/src/L0g.php@39 Function: error()
		/var/www/dc/app/Http/Controllers/XController.php@11 Function: xmethod()
		/var/www/dc/vendor/laravel/framework/src/Illuminate/Routing/Controller.php@54 Function: callAction()
__________________________________________________________________________________________________  
```

#### ***Helpers.php file

* _vers - use in blade files to import css/js/fonts/images or any other medias within the application that puts a version at end of its url. Version string will contain the modified timestamp of the file

Parameters:

\- String $urlFile - file url of the resource within the application public or storage folder

\- Bool $onlyVersion - output the version only instead of the whole url + version, default is false

Return: String

Sample usage:

`_vers('/images/logo.png');`

Sample output:

`https://localhost/images/logo.png?v=22343423`

* _trim - use to limit the number of characters of a string then puts a string at the end. If there is more than characters than the max limit then it will concatenate a string suffix that is given in the parameter

Parameters:

\- String $string - string/text to be trimmed

\- Int $limit - number of characters to cut, default is 50 characters

\- String $withSuffix - suffix to be given if string exceed the limit

Return: String

Sample usage:

`_trim('hello world', 7, '...')`

Sample output:

`"hello w..."`

* _trimText - the same as the _trim() method, but will remove any html tags that is within the string

Parameters:

\- String $string - string/text to be trimmed

\- Int $limit - number of characters to cut, default is 50 characters

\- String $withSuffix - suffix to be given if string exceed the limit

Return: Boolean true/false

Sample usage:

`_trim('hello world', 7, '...')`

Sample output:

`"hello w..."`

* _isRoute - use to check the current route of the page

Parameters:

\- String $routeName - the route name to be check

Return: Bool/String false/"active"

Sample usage:

`_isRoute('user.index')`

## License

this package is free, open source, and GPL friendly. You can use it for
commercial projects, open source projects, or really almost whatever you want.

- Code — MIT License
