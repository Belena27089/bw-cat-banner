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

if (!defined('_PS_VERSION_')) {
    exit;
}

class BWCatHtml extends ObjectModel
{
    public $id_item;
    public $id_shop;
    public $specific_class;
    public $title;
    public $content;

    public static $definition = array(
        'table'        => 'bwcatbanner_html',
        'primary'      => 'id_item',
        'multilang'    => true,
        'fields'       => array(
            'id_shop'           => array('type' => self::TYPE_INT, 'validate' => 'isunsignedInt'),
            'specific_class'    => array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml', 'size' => 128),
            'title'             => array('type' => self::TYPE_STRING,
                                         'lang' => true, 'validate' => 'isGenericName', 'required' => true, 'size' => 128),
            'content'           => array('type' => self::TYPE_HTML,
                                         'lang' => true, 'validate' => 'isCleanHtml', 'size' => 4000),
        ),
    );

    /*****
    ****** Get list of custom HTML items
    ****** return all items data
    *****/
    public function getHtmlList()
    {
        $sql = 'SELECT bwh.*, bwhl.`title`, bwhl.`content`
                FROM `'._DB_PREFIX_.'bwcatbanner_html` bwh
                LEFT JOIN `'._DB_PREFIX_.'bwcatbanner_html_lang` tmhl
                ON (bwh.`id_item` = bwhl.`id_item`)
                WHERE bwh.`id_shop` = '.(int)Context::getContext()->shop->id.'
                AND bwhl.`id_lang` = '.(int)Context::getContext()->language->id;

        return Db::getInstance()->executeS($sql);
    }
}
