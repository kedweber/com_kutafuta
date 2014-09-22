# Kutafuta

## Introduction

Search function for the Moyo CCK. Instead of searching into `com_content`, it searches into its own indexed tables. This
enables the developer to make content from their components searchable at a whim.

Kutafuta was developed by [Moyo Web Architects](http://moyoweb.nl).

## Requirements

* Joomla 3.X . Untested in Joomla 2.5.
* Koowa 0.9 or 1.0 (as yet, Koowa 2 is not supported)
* PHP 5.3.10 or better
* Composer
* Moyo Components
    * com_cck
    * com_moyo

## Installation

### Composer

Installation is done through composer. In your `composer.json` file, you should add the following lines to the repositories
section:

```json
{
    "name": "cta/kutafuta",
    "type": "vcs",
    "url": "https://github.com/cta-int/kutafuta.git"
}
```

The require section should contain the following line:

```json
    "cta/kutafuta": "1.0.*",
```

Afterward, just run `composer update` from the root of your Joomla project.

### jsymlinker

Another option, currently only available for Moyo developers, is by using the jsymlink script from the [Moyo Git
Tools](https://github.com/derjoachim/moyo-git-tools).

## Configuration

Upon installing, all that needs to be done is enable the Kutafuta plugin. It is in the 'search' group.

## Usage

The components and other items that are to be searchable, need to be indexed. As yet, this is a one time manual procedure.
Any component with kutafuta support has a button in the plural views that are labeled `index`. For each language, each
element, click once. Wait a while and you're done.

### Development notes

Please note that for automatic indexing, the `indexable` controller behavior and `searchable` database behaviors are to
be added to the indexable items.