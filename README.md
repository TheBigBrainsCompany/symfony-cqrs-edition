# The Big Brains Company - Symfony Standard CQRS

A default structure for CQRS oriented project and Symfony.

## What's inside?

**TODO**

## Requirements

* PHP >= 5.3.3
* NodeJs with Npm
* grunt-cli npm package
* bower npm package


## 1. Installing the project

As Symfony uses Composer to manage its dependencies, the recommended way to create a new project is to use it.

If you don't have Composer yet, download it following the instructions on http://getcomposer.org/ or just run the following command:

```bash
$ curl -s http://getcomposer.org/installer | php
```

Then, use the create-project command to generate a new application:

```bash
$ php composer.phar create-project tbbc/symfony-standard-cqrs path/to/install dev-master
```

Composer will install the project and all its dependencies under the `path/to/install` directory.

**Note**: _Because it is not stable yet, you have to explicity set the `dev-master` version._


## 2. Configuring the project

In addition to the composer installation and in order to complete your installation, you need to do the following steps:

### 2.1 Configuring and installing assets

You need to copy the `config.json.dist` file to `config.json` and edit it if necessary.

```bash
$ cp config.json.dist config.json
```

Then, you just need to run `grunt` from the command line:

```bash
$ grunt
```

**Note**

During development, you can use the `grunt watch` command to track live changes from your css and/or javascript
files and having grunt automatically recompiling them:

```bash
$ grunt watch
```

### 2.2 Initializing the read/write databases

```bash
$ app/console doctrine:database:create
$ app/console doctrine:schema:create --em=write
$ app/console acme:task:create-task-view-model-schema
```

### 2.3 Importing the "Task" demo fixtures

```bash
$ app/console doctrine:fixtures:load
```

## 3. Browsing the "Task" demo application

Congratulations! You're now ready to use the project.

To see a real-live CQRS mini-project in action, access the following page:

```
web/app_dev.php/
```

## 4. Getting started with CQRS

**TODO**
