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

$sql[] = 'DROP TABLE `'._DB_PREFIX_.'bwcatbanner`';

$sql[] = 'DROP TABLE `'._DB_PREFIX_.'bwcatbanner_lang`';

$sql[] = 'DROP TABLE `'._DB_PREFIX_.'bwcatbanner_items`';

$sql[] = 'DROP TABLE `'._DB_PREFIX_.'bwcatbanner_html`';

$sql[] = 'DROP TABLE `'._DB_PREFIX_.'bwcatbanner_html_lang`';

$sql[] = 'DROP TABLE `'._DB_PREFIX_.'bwcatbanner_link`';

$sql[] = 'DROP TABLE `'._DB_PREFIX_.'bwcatbanner_link_lang`';

$sql[] = 'DROP TABLE `'._DB_PREFIX_.'bwcatbanner_banner`';

$sql[] = 'DROP TABLE `'._DB_PREFIX_.'bwcatbanner_banner_lang`';


foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}
