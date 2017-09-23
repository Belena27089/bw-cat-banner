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
* @author     Bistrjva Elena
* @copyright  2017 Belenaweb
* @license    http://opensource.org/licenses/GPL-2.0 General Public License (GPL 2.0)
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class BWCatMenuBanner extends ObjectModel {

    public $id_shop;
    public $specific_class;
    public $title;
    public $blank;
    public $url;
    public $image;
    public $public_title;
    public $description;
    public static $definition = array(
        'table' => 'bwcatbanner_banner',
        'primary' => 'id_item',
        'multilang' => true,
        'fields' => array(
            'id_shop' => array('type' => self::TYPE_INT, 'validate' => 'isunsignedInt', 'required' => true),
            'specific_class' => array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml', 'size' => 128),
            'title' => array('type' => self::TYPE_STRING, 'lang' => true,
                'validate' => 'isGenericName', 'required' => true, 'size' => 128),
            'blank' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'url' => array('type' => self::TYPE_STRING, 'lang' => true,
                'validate' => 'isUrl', 'required' => true, 'size' => 255),
            'image' => array('type' => self::TYPE_STRING, 'lang' => true,
                'validate' => 'isUrl', 'required' => true, 'size' => 255),
            'public_title' => array('type' => self::TYPE_STRING, 'lang' => true,
                'validate' => 'isGenericName', 'size' => 128),
            'description' => array('type' => self::TYPE_HTML, 'lang' => true,
                'validate' => 'isCleanHtml', 'size' => 4000),
        )
    );

    public function add($autodate = true, $null_values = false) {
        $res = parent::add($autodate, $null_values);
        return $res;
    }

    public function delete() {
        $res = true;

        $images = $this->image;
        if ($images) {
            foreach ($images as $image) {
                if ($image && file_exists(_PS_MODULE_DIR_ . 'bwcatbanner/images/' . $image)) {
                    $res &= @unlink(_PS_MODULE_DIR_ . 'bwcatbanner/images/' . $image);
                }
            }
        }

        $res &= parent::delete();
        return $res;
    }

    /*     * ***
     * ***** Get list of banners
     * ***** return all items data
     * *** */

    public function getBannersList() {
        $sql = 'SELECT bwb.*, bwbl.`title`, bwbl.`url`, bwbl.`image`
                FROM `' . _DB_PREFIX_ . 'bwcatbanner_banner` bwb
                LEFT JOIN `' . _DB_PREFIX_ . 'bwcatbanner_banner_lang` bwbl
                ON (bwb.`id_item` = bwbl.`id_item`)
                WHERE bwb.`id_shop` = ' . (int) Context::getContext()->shop->id . '
                AND bwbl.`id_lang` = ' . (int) Context::getContext()->language->id;

        return Db::getInstance()->executeS($sql);
    }

}
