<?php
/*
* 2017 Belenaweb
*
* BW Cat Banner
*
* NOTICE OF LICENSE
*
* This source file is subject to the General Public License (GPL 2.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/GPL-2.0
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade the module to newer
* versions in the future.
*
* @author     Bistrova Elena
* @copyright  2017 Belenaweb
* @license    http://opensource.org/licenses/GPL-2.0 General Public License (GPL 2.0)
*/

$sql = array();

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'bwcatbanner` (
    `id_item` int(11) NOT NULL AUTO_INCREMENT,
	`id_shop` int(11) NOT NULL DEFAULT \'1\',
	`sort_order` int(11) NOT NULL DEFAULT \'0\',
	`specific_class` VARCHAR(100),
	`is_mega` int(11) NOT NULL DEFAULT \'0\',
	`is_simple` int(11) NOT NULL DEFAULT \'0\',
	`is_custom_url` int(11) NOT NULL DEFAULT \'0\',
	`url` VARCHAR(100),
	`active` int(11) NOT NULL DEFAULT \'1\',
	`unique_code` VARCHAR(100),
    PRIMARY KEY  (`id_item`)
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'bwcatbanner_lang` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
	`id_item` int(11) NOT NULL,
	`id_lang` int(11) NOT NULL,
	`title` VARCHAR(100),
	`badge` VARCHAR(100),
    PRIMARY KEY  (`id`)
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'bwcatbanner_items` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
	`id_tab` int(11) NOT NULL,
	`row` int(11) NOT NULL DEFAULT \'1\',
	`col` int(11) NOT NULL DEFAULT \'1\',
	`width` int(11),
	`class` VARCHAR(100),
	`type` int(11) NOT NULL DEFAULT \'0\',
	`is_mega` int(11) NOT NULL DEFAULT \'0\',
	`settings` VARCHAR(10000),
    PRIMARY KEY  (`id`)
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'bwcatbanner_html` (
    `id_item` int(11) NOT NULL AUTO_INCREMENT,
	`id_shop` int(11) NOT NULL DEFAULT \'1\',
	`specific_class` VARCHAR(100),
    PRIMARY KEY  (`id_item`)
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'bwcatbanner_html_lang` (
	`id_item` int(10) unsigned NOT NULL,
	`id_lang` int(11) NOT NULL,
	`title` VARCHAR(100),
	`content` text NOT NULL,
    PRIMARY KEY (`id_item`, `id_lang`)
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'bwcatbanner_link` (
    `id_item` int(11) NOT NULL AUTO_INCREMENT,
	`id_shop` int(11) NOT NULL DEFAULT \'1\',
	`specific_class` VARCHAR(100),
	`blank` int(11) NOT NULL,
    PRIMARY KEY  (`id_item`)
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'bwcatbanner_link_lang` (
	`id_item` int(10) unsigned NOT NULL,
	`id_lang` int(11) NOT NULL,
	`title` VARCHAR(100),
	`url` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id_item`, `id_lang`)
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'bwcatbanner_banner` (
    `id_item` int(11) NOT NULL AUTO_INCREMENT,
	`id_shop` int(11) NOT NULL DEFAULT \'1\',
	`specific_class` VARCHAR(100),
	`blank` int(11) NOT NULL,
    PRIMARY KEY (`id_item`, `id_shop`)
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'bwcatbanner_banner_lang` (
	`id_item` int(10) unsigned NOT NULL,
	`id_lang` int(11) NOT NULL,
	`title` VARCHAR(100),
	`url` VARCHAR(100) NOT NULL,
	`image` VARCHAR(100) NOT NULL,
	`public_title` VARCHAR(100),
	`description` text NOT NULL,
	PRIMARY KEY (`id_item`, `id_lang`)
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';

foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}
