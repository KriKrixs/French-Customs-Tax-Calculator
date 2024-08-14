# RandomTools

Link to use them : [https://tools.barusseau.fr/](https://tools.barusseau.fr/)

This is a web toolbox containing different type of mini tools that i found useful

## Tools list

Maybe someday, those tools will be out of date regarding current regulation or anything else.

If it's the case, [create a new issue](https://github.com/KriKrixs/RandomTools/issues/new) with the following title `[Tool Name] - Outdated` and a detailed description

- [**French Customs Tax Calculator**](https://tools.barusseau.fr/cars/fr-customs-tax-calculator)

    Calculate the price of the customs tax when importing a UK car based on the buy price in pound.


- [**UK Car Bill Generator**](https://tools.barusseau.fr/cars/uk-car-bill-generator)

    Generate a bill that you need to provide the seller in order to pay the customs tax and register a UK car in France

## Requirements

- PHP 8.3
- Composer 2
- wkhtmltopdf

## Install

- First, ensure you pass all the symfony requirements by running this command

``` bash
$ symfony check:requirements
```

- Install the software called `wkhtmltopdf` following their [website](https://wkhtmltopdf.org)
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
