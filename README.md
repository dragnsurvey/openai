# Laravel OpenAI Package

## Description
Laravel OpenAI Package is a Laravel wrapper for the OpenAI API, providing easy integration and usage of OpenAI's capabilities such as GPT-3, DALL-E, and more within Laravel applications. This package simplifies the process of connecting to OpenAI's API and performing various AI-driven tasks.

## Features
- Easy integration with Laravel projects.
- Supports various OpenAI API functionalities like Chat, Image Generation, etc.
- Customizable to fit specific use cases.

## Requirements
- PHP >= 7.4
- Laravel >= 8.0
- Guzzle HTTP Client

## Installation

Install the package via Composer:

```bash
composer require dragnsurvey/openai
```

After installing, publish the configuration file (if needed):

```bash
php artisan vendor:publish --provider="Dragnsurvey\OpenAi\OpenAiServiceProvider"
```

## Configuration

To configure the package, add your OpenAI API key to your `.env` file:

```env
OPENAI_API_KEY=your_api_key_here
```

Set other configuration options in `config/openai.php` (if the configuration file was published).

## Usage

### Using Chat API
To use the Chat API:

```php
use Dragnsurvey\OpenAi\Chat\ChatRequest;

$chatRequest = new ChatRequest();
$chatRequest->addSystemMessage("You answer questions about football using the tone of a sportscaster ");
$chatRequest->addUserMessage("Hello, who won the world cup in 1998?");
$response = $chatRequest->send();

print_r($response);
```

### Using Image Generation API
To use the Image Generation API:

```php
use Dragnsurvey\OpenAi\Image\ImageRequest;

$imageRequest = new ImageRequest();
$imageRequest->setPrompt("A two-headed dragon");
$response = $imageRequest->send();

//OR 
$imageRequest = new ImageRequest("A two-headed dragon");
$response = $imageRequest->send();


print_r($response);
```

## Advanced Usage
For advanced usage, refer to [OpenAI's official documentation](https://openai.com/api/).

## Testing
Run the tests with:

```bash
vendor/bin/phpunit
```

## Contributing
Contributions are welcome, and any help is greatly appreciated.

## License
This package is open-sourced software licensed under the [MIT license](LICENSE.md).

## Credits
- Roman STEC (https://www.dragnsurvey.com)

