# JiNexus Framework Skeleton

## Introduction

This is a skeleton application using the JiNexus Framework MVC layer and module
systems. This application is meant to be used as a starting place for those
looking to use JiNexus Framework.

## System Requirements
   
##### JiNexus Framework 1.x.x requires:

* PHP 5.6 or later
* Mod_Rewrite
* Mbstring

## Setup

To create your new JiNexus Framework application, first make sure you're using PHP 5.6 or later and have [Composer](https://getcomposer.org/) installed. You may also check how to install composer in their [documentation](https://getcomposer.org/download/). 

All you have to do—to create your new JiNexus Framework project is to run this one single line command:

```bash
$ composer create-project jinexus-framework/jinexus-framework-skeleton path/to/my-project
```

This will create a new my-project directory, download some dependencies into it and even generate the basic directories and files you'll need to get started. In other words, your new app is ready!

Next you'll have to make project directories writable (command may vary depending on your system):

```bash
$ chown -R www-data:www-data path/to/my-project
```

```bash
$ chmod -R g+rwX path/to/my-project
```

## Start a Web Server
The Skeleton creates a full application structure that's ready-to-go when complete. You can test it out using [built-in web server](http://php.net/manual/en/features.commandline.webserver.php).

From the project root directory, execute the following: 

#### Using Composer

```bash
$ composer run --timeout=0 serve
```

This starts up a web server on localhost port 8080; browse to http://localhost:8080/ to see if your application responds correctly!

```bash
$ php -S localhost:8000
```

This starts up a web server on localhost port 8000; browse to http://localhost:8000/ to see if your application responds correctly! 

---

- File issues at https://github.com/jinexus-framework/jinexus-http/issues
- Documentation is at https://framework.jinexus.com/documentation