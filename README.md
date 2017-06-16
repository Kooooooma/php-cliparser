# php-cliparser
php 命令行参数解析器. PHP cli args parser.

# Install
```php
{
    "require" :{
        "php-cliparser/php-cliparser": "~1.0"
    }
}
```

# Usage
```php
// /path/to/your/scriptfile.php --config test.yml -d -n 1 --name koma
$parser = new \CliParser\CliParser();
$parser->parse();

var_dump($parser->hasArgs('config'));
var_dump($parser->getArgs('config'));
var_dump($parser->getAllArgs());
```
