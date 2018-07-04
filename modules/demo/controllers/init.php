<?php
/**
 * @filesource modules/demo/controllers/init.php
 *
 * @see http://www.kotchasan.com/
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 */

namespace Demo\Init;

use Kotchasan\Http\Request;

/**
 * Init Module.
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Controller extends \Kotchasan\KBase
{
    /**
     * ฟังก์ชั่นเริ่มต้นการทำงานของโมดูลที่ติดตั้ง
     * และจัดการเมนูของโมดูล.
     *
     * @param Request                $request
     * @param \Index\Menu\Controller $menu
     * @param array                  $login
     */
    public static function execute(Request $request, $menu, $login)
    {
        // รายการเมนูย่อย
        $submenus = array(
            array(
                'text' => 'Typography',
                'url' => 'index.php?module=demo&amp;page=typography',
            ),
            array(
                'text' => 'Message',
                'url' => 'index.php?module=demo&amp;page=message',
            ),
            array(
                'text' => 'Form &amp; Form Component',
                'url' => 'index.php?module=demo&amp;page=form',
            ),
            array(
                'text' => 'District Amphur Province',
                'url' => 'index.php?module=demo-multiselect',
            ),
            array(
                'text' => 'Auto Complete',
                'url' => 'index.php?module=demo-autocomplete',
            ),
            array(
                'text' => 'Ajax Upload',
                'url' => 'index.php?module=demo-upload',
            ),
            array(
                'text' => 'Graphs',
                'url' => 'index.php?module=demo&amp;page=graphs',
            ),
            array(
                'text' => 'Table',
                'url' => 'index.php?module=demo-table',
            ),
            array(
                'text' => 'Grid',
                'url' => 'index.php?module=demo&amp;page=grid',
            ),
            array(
                'text' => 'Icons',
                'url' => WEB_URL . 'skin/index.html',
                'target' => '_blank',
            ),
        );
        // สร้างเมนูบนสุดก่อนเมนู settings
        $menu->addTopLvlMenu('demo', 'Demo', null, $submenus, 'settings');
    }

    /**
     * รายการ permission ของโมดูล.
     *
     * @param array $permissions
     *
     * @return array
     */
    public static function updatePermissions($permissions)
    {
        // ตัวอย่างการกำหนด permission ของโมดูล
        $permissions['can_view'] = 'สามารถเปิดดูโมดูลได้';

        return $permissions;
    }
}
