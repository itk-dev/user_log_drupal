# User Log Drupal Module

Drupal module for logging deletion of users.

## Installation

```shell
composer require itkdev/user_log_drupal
vendor/bin/drush pm:enable itkdev_user_log
```


## Usage

After having enabled the module go to
`/itkdev_user_log` to see the standard view of deleted users.

Note, that logging is only done on deleted users,
meaning disabling users will not be logged.

## Coding standards

The following commands let you test that the code follows the coding standards
we decided to adhere to in this project.

```shell
composer install
composer coding-standards-check/phpcs
composer coding-standards-apply/phpcs
```

## License

This project is licensed under the MIT License - see the
[LICENSE.md](LICENSE.md) file for details.
