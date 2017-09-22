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

class AdminBWCatBannerController extends ModuleAdminController
{
    public $styles = '';

    public function ajaxProcessTabupdate()
    {
        $bwcatmenu = new BWCatMenu();
        $id_tab = Tools::getValue('id_tab');
        if (Tools::isEmpty(Tools::getValue('data'))) {
            $data = 'empty'; // send if menu is empty for remove it from databese
        } else {
            $data = Tools::getValue('data');
        }

        if (!$bwcatmenu->addMenuItem($id_tab, $data)) {
            die(Tools::jsonEncode(array('error_status' => $this->l('Update Fail'))));
        }
        die(Tools::jsonEncode(array('success_status' => $this->l('Update Success !'), 'error' => false)));
    }

    public function ajaxProcessUpdatePosition()
    {
        $items = Tools::getValue('item');
        $total = count($items);
        $id_shop = (int)$this->context->shop->id;
        $success = true;
        for ($i = 1; $i <= $total; $i++) {
            $success &= Db::getInstance()->update(
                'bwcatbanner',
                array('sort_order' => $i),
                '`id_item` = '.preg_replace('/(item_)([0-9]+)/', '${2}', $items[$i - 1]).'
                AND `id_shop` ='.$id_shop
            );
        }
        if (!$success) {
            die(Tools::jsonEncode(array('error' => 'Update Fail')));
        }
        die(Tools::jsonEncode(array('success' => 'Update Success !', 'error' => false)));
    }

    public function ajaxProcessGenerateStyles()
    {
        $gdata = Tools::getValue('data');
        $gcssname = Tools::getValue('cssname');
        $result = true;
        foreach ($gdata as $data) {
            $data = explode('|', $data);
            // check if class has value
            if (!Tools::isEmpty(trim($data[1]))) {
                $this->styles .= '.bwcatbanner_item.'.$data[0].' {';
                $data_values = explode('^,', $data[1]);
                foreach ($data_values as $value) {
                    $val = explode(':', str_replace('^', '', $value));
                    if (isset($val[1]) && !Tools::isEmpty($val[1])) {
                        $this->styles .= str_replace('^', '', $value).';';
                    }
                }
                $this->styles .= "}\n";
            }
        }
        // check is something to write in css
        if (!Tools::isEmpty($this->styles)) {
            $file = fopen(Bwcatbanner::stylePath().$gcssname.'.css', 'w');
            fwrite($file, $this->styles);
            $result &= fclose($file);
            $result &= Bwcatbanner::generateUniqueStyles();
        }
        if ($result) {
            die(Tools::jsonEncode(array('status' => 'success', 'message' => $this->l('Update Success !'))));
        }
        die(Tools::jsonEncode(array('status' => 'error', 'message' => $this->l('Update Fail'))));
    }

    public function ajaxProcessResetStyles()
    {
        $gcssname = Tools::getValue('cssname');
        $result = true;

        if (file_exists(Bwcatbanner::stylePath().$gcssname.'.css')) {
            $result &= @unlink(Bwcatbanner::stylePath().$gcssname.'.css');
            $result &= Bwcatbanner::generateUniqueStyles();
        }

        if ($result) {
            die(Tools::jsonEncode(array('status' => 'success', 'message' => $this->l('Reset success !'))));
        }
        die(Tools::jsonEncode(array('status' => 'error', 'message' => $this->l('Reset Fail'))));
    }
}
