# ActualUserBundle

This bundle provides an opportunity to refresh user roles after its changing without re-authentication

## Installation

1. Install this bundle using composer

``` bash
    $ composer require 11ya/actual-user-bundle
```
or add the package to your ``composer.json`` file directly.

2. Register the bundle in ``app/AppKernel.php``

``` php
    $bundles = array(
        // ...
        new Ilya\ActualUserBundle\IlyaActualUserBundle(),
    );
```

## Usage

1. Implement ActualUserInterface in your User class.
2. [Modify security config](http://symfony.com/doc/current/security/custom_provider.html#modify-security-yml) to use custom provider service
3. Enjoy!