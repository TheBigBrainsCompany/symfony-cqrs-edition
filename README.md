# The Big Brains Company - Symfony Standard CQRS

A default structure for CQRS oriented project and Symfony.

## What's inside?

**TODO**


## 1. Installing the project

As Symfony uses Composer to manage its dependencies, the recommended way to create a new project is to use it.

If you don't have Composer yet, download it following the instructions on http://getcomposer.org/ or just run the following command:

```bash
$ curl -s http://getcomposer.org/installer | php
```

Then, use the create-project command to generate a new application:

```bash
$ php composer.phar create-project tbbc/symfony-standard-cqrs path/to/install
```

Composer will install the project and all its dependencies under the `path/to/install` directory.


## 2. Configuring the project

In addition to the composer installation and in order to complete your installation, you need to do the following steps:

### 2.1 Copying the `config.json.dist` to `config.json`

You need to copy the file and edit it if necessary.

```bash
$ cp config.json.dist config.json
```

### 2.2 Configuring and installing assets

You'll need to have NodeJS with `grunt-cli` and `bower` installed on your local machine in order to install the project assets.

To install grunt, just run the following command (debian based system):

```bash
$ sudo npm install -g grunt-cli bower
```

Then, install the project npm and bower dependencies:

```bash
$ npm install
$ bower install
```

And finally, initialize the project assets with grunt:

```bash
$ grunt
```

### 2.3 Initializing the read/write databases

```bash
$ app/console doctrine:database:create
$ app/console doctrine:schema:create --em=write
$ app/console acme:task:create-task-view-model-schema
```

### 2.4 Importing the "Task" demo fixtures

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