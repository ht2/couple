# Couple
> Port of [ryansmith94/couple](https://github.com/ryansmith94/couple) from JS to PHP. A library for coupling two objects together. This is useful for nested pattern matching.

[![Build Status](https://travis-ci.org/ht2/couple.svg)](https://travis-ci.org/ht2/couple)
[![Latest Stable Version](https://poser.pugx.org/ht2/couple/v/stable.svg)](https://packagist.org/packages/ht2/couple)
[![Total Downloads](https://poser.pugx.org/ht2/couple/downloads.svg)](https://packagist.org/packages/ht2/couple)
[![License](https://poser.pugx.org/ht2/couple/license.svg)](https://packagist.org/packages/ht2/couple)
[![Gitter](https://badges.gitter.im/Join Chat.svg)](https://gitter.im/ht2/couple?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge)

If you have a bug, enhancement, or question you can post it in the [issues](/issues), however, please see the [guidelines](/contributing.md) before doing so. You may also ask questions and chat on [Gitter](https://gitter.im/ht2/couple).

## Users
Documentation can be found in the [docs](/docs) directory. Install using `composer require ht2/couple`.

## Developers
You may contribute to this project via [issues](/issues) and [pull request](/pulls), however, please see the [guidelines](/contributing.md) before doing so.

### Getting Started
1. [Fork](/fork) the repository.
2. Clone your forked version of the repository.
3. Run `composer install`.
4. Change the code.
5. See [Testing](#testing) below for more information.
6. Repeat from Step 4 or continue to step 7.
7. Commit and push your changes to Github.
8. Create a [pull request](/pulls) on Github (ensuring that you follow the [guidelines](/contributing.md)).

### Directory Structure
- [src](/src) - Source code written in PHP.
- [tests](/tests) - Testing code written in PHP.
- [docs](/docs) - Documentation written in "Github Flavoured Markdown".

### Testing
You should try to ensure that `./vendor/bin/phpunit tests` runs without any errors before submitting a pull request.
