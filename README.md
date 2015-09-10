[![Build Status](https://travis-ci.org/libgraviton/json-schema.png?branch=develop)](https://travis-ci.org/libgraviton/json-schema) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/libgraviton/json-schema/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/libgraviton/json-schema/?branch=develop) [![Code Coverage](https://scrutinizer-ci.com/g/libgraviton/json-schema/badges/coverage.png?b=develop)](https://scrutinizer-ci.com/g/libgraviton/json-schema/?branch=develop) [![Latest Stable Version](https://poser.pugx.org/graviton/json-schema/v/stable.svg)](https://packagist.org/packages/graviton/json-schema) [![Total Downloads](https://poser.pugx.org/graviton/json-schema/downloads.svg)](https://packagist.org/packages/graviton/json-schema) [![License](https://poser.pugx.org/graviton/json-schema/license.svg)](https://packagist.org/packages/graviton/json-schema)

# graviton/json-schema

This repository contains [JSON schemas](http://json-schema.org/) we use to validate our documents against as well as the tooling required to do so.

## Schemata

* [LoadConfigObject Schema](schema/loadconfig/v1.0/schema.json)<br />A schema describing the format of our JSON Loader Definition files (_LoadConfigObjects_)

## Installation

```
composer require graviton/json-schema
```

## Usage

```
./vendor/bin/graviton-validate-directory
./vendor/bin/graviton-validate-file
```
