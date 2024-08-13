# French Customs Tax Calculator

This little tool calculate the price of the customs tax when importing a UK car based on the buy price.

Maybe someday, this tool will be out of date regarding current regulation.
If it's the case, [create a new issue](https://github.com/KriKrixs/French-Customs-Tax-Calculator/issues/new)

Since i'm kinda lazy, i decided to gain on dev time and base this tool on Symfony 6.4 even if it's overkill. Will probably remake it on PHP vanilla this later this year.

## Requirements

- PHP 8.3
- Composer 2

## Install

- First, ensure you pass all the symfony requirements by running this command

``` bash
$ symfony check:requirements
```

- Copy the `.env.local.template` file and paste it as `.env.local`
- Fill all the variables
- Install all the dependencies by running this command

``` bash
$ composer install
```

- For the first time and at every change of the JS or CSS files, copy the assets using this command

```bash
$ php bin/console asset-map:compile
```

### For development only

- Run the local server in the project root folder by running those commands

```bash
$ symfony serve # Don't close the terminal that runs this command
```

- The tool is now available on `http://localhost:8000`

## ChangeLog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please create a new issue with the corresponding filters on [GitHub - Issues](https://github.com/KriKrixs/French-Customs-Tax-Calculator/issues/new).
