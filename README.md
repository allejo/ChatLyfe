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

During the initial setup of the dev environment, you'll likely have to setup ACL for the cache and log folders.

```bash
bash app/setup-acl.sh
```

To get started with development, use the first command to start a web server for Symfony and then running the Gulp task will automatically reload the website and recompile our Sass when changes are made.

```bash
app/console server:start
node_modules/.bin/gulp dev:watch
```

## Deployment

All front-end assets are compiled and committed to Git, so it's only necessary to pull back-end dependencies through Composer and build the autoloader.

During the initial deployment of the website, it's necessary to setup ACL for the cache and log folders. This script will ask for super user privileges to configure ACL.

```bash
bash app/setup-acl.sh
```

Regular deployment and updates to the website can be done through the `deploy.sh` script. The script will pull from Git and update the necessary files.

To update the production website, use the `--prod` flag.

```bash
bash deploy.sh --prod
```

To update the staging environment, run the script without the flag.

```bash
bash deploy.sh
```

## Branching

The `master` branch should reflect what is deployed to the production site and the `develop` branch should reflect what is on the staging site.

All new features or changes should be done in branches. When the features are ready/complete, create a pull request against the `develop` branch and wait for someone else to review the code before merging or merge it in yourself if the change is small enough.

As new features are ready to be deployed, a separate PR should be open from the `deploy` branch against the `master` and needs to be reviewed again before things are merged and deployed to production.
