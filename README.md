# ChatLyfe

[![Build Status](https://travis-ci.com/allejo/ChatLyfe.svg?token=N8pP5syRDREGy8yzpAqR&branch=master)](https://travis-ci.com/allejo/ChatLyfe)

A [Symfony](https://symfony.com/doc/2.8/index.html) project.

## Getting Set Up

Set up the base of the project with all PHP dependencies.

```npm
composer install
```

All of the front-end assets are maintained through npm.

```bash
npm install
```

Be sure to have an [EditorConfig](http://editorconfig.org) compatible IDE/editor if you plan on editing any of the files.

## Building Stylesheets

To build a distribution ready stylesheet there is a Gulp task for it.

```bash
node_modules/.bin/gulp sass:dist
```

## Developing

To get started with development, use the first command to start a web server for Symfony and then running the Gulp task will automatically reload the website and recompile our Sass when changes are made.

```bash
app/console server:start
node_modules/.bin/gulp dev:watch
```
