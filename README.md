# The Big Brains Company - Symfony CQRS Edition

A default structure for CQRS oriented project and Symfony.

## What's inside?

**TODO**

## Requirements

* PHP >= 5.3.3
* NodeJs with Npm
* grunt-cli npm package
* bower npm package

## 1. Quick start

### 1.1 The project structure

DDD (Domain Driven Development) and CQRS (Command/Query Responsability Segregation) aims to focus on the domain (ie: your business).

This project structure tries to properly separate the technical aspects and the actual business logic.

Based on previous experiments, POO paradigms, DDD best practices, we have defined three main "layers" for an application.

#### 1.1.1 The Domain

It gathers the actual business logic, business rules, free of any framework implementations

This layers is splitted in two parts, as defined by the CQRS abbreviation.

The Command layer is somewhat the write layer, in charge of updating the state of your domain, while the Query is 
in charge of Reporting.

#### 1.1.2 The Infrastructure

Infrastructure relates to any components that are not part of your domain and which interchangeables.
This can be a Doctrine/DBAL repository, a Mailer service, or any third parties adapter.
This is also here that we do the glue between the domain and any MVC framework.

#### 1.1.3 The UI

CQRS/DDD mainly focus on a "Task Based UI", this means tasks are often mapped to actual command of your domain.
UI, User Interface, is usually a website with HTML views, but it is also any CLI commands or even a REST API.

#### 1.1.4 Default structure

```
src
└── Acme
    └── Task
        ├── Command
        ├── Domain
        │   ├── Event
        │   ├── Handler
        │   ├── Model
        │   └── Repository
        ├── Infrastructure
        │   ├── InfrastructureBundle
        │   └── Persistence
        ├── Query
        │   ├── EventHandler
        │   ├── Repository
        │   └── ViewModel
        └── Ui
            ├── CliBundle
            ├── SharedBundle
            └── WebBundle
```

In the Symfony CQRS Edition, the InfrastructureBundle is the heart of the application. It is the glue
between your domain and the actual Symfony framework.

The UI layer contains all the Controllers, as well as views, themes, or any configuration which will
be passed through container parameters to your Domain.

**Note**: *the term Command may apply to both CLI Command and Command in <strong>C</strong>QRS, it should not be confused as it
refers to two different concepts*

## 2. Installing the project

As Symfony uses Composer to manage its dependencies, the recommended way to create a new project is to use it.

If you don't have Composer yet, download it following the instructions on http://getcomposer.org/ or just run the following command:

```bash
$ curl -s http://getcomposer.org/installer | php
```

Then, use the create-project command to generate a new application:

```bash
$ php composer.phar create-project tbbc/symfony-cqrs-edition path/to/install dev-master
```

Composer will install the project and all its dependencies under the `path/to/install` directory.

**Note**: _Because it is not stable yet, you have to explicity set the `dev-master` version._


## 3. Configuring the project

In addition to the composer installation and in order to complete your installation, you need to do the following steps:

### 3.1 Configuring and installing assets

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

### 3.2 Initializing the read/write databases

```bash
$ app/console doctrine:database:create
$ app/console doctrine:schema:create --em=write
$ app/console acme:task:create-task-view-model-schema
```

### 3.3 Importing the "Task" demo fixtures

```bash
$ app/console doctrine:fixtures:load
```

## 4. Browsing the "Task" demo application

Congratulations! You're now ready to use the project.

To see a real-live CQRS mini-project in action, access the following page:

```
web/app_dev.php/
```

## 5. Getting started with CQRS

**TODO**


## 6. Contributing

1. Take a look at the [list of issues](http://github.com/TheBigBrainsCompany/symfony-cqrs-edition).
2. Fork
3. Write a test (for either new feature or bug)
4. Make a PR

## 7. Authors

* Boris Guéry    - guery.b@gmail.com  - [@borisguery](http://twitter.com/borisguery) - http://borisguery.com
* Benjamin Dulau - benjamin.dulau@gmail.com - [@delendial](http://twitter.com/delendial) - http://benjamindulau.com

## 8. License

`The Big Brains Company - Symfony CQRS Edition` is licensed under the MIT License - see the LICENSE file for details
