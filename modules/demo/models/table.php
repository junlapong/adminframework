<?php
/**
 * @filesource modules/demo/models/table.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Demo\Table;

use Gcms\Login;
use Kotchasan\Http\Request;
use Kotchasan\Language;

/**
 * ตารางสมาชิก
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Model extends \Kotchasan\Model
{
    /**
     * รับค่าจากตาราง (table.php).
     *
     * @param Request $request
     */
    public function action(Request $request)
    {
        $ret = array();
        // session, referer, can_config
        if ($request->initSession() && $request->isReferer() && $login = Login::checkPermission(Login::isMember(), 'can_config')) {
            // รับค่าจากการ POST
            $action = $request->post('action')->toString();
            if ($action == 'preview') {
                $ret['modal'] = Language::trans(createClass('Demo\Preview\View')->render($request));
            } else {
                // ตรวจสอบค่าที่ส่งมา
                print_r($_POST);
            }
        }
        if (!empty($ret)) {
            // คืนค่า JSON
            echo json_encode($ret);
        }
    }

    /**
     * อ่านข้อมูลสำหรับใส่ลงในตาราง.
     *
     * @return array
     */
    public static function toDataTable()
    {
        $model = new static();

        return $model->db()->createQuery()
            ->select('id', 'name', 'active', 'fb', 'phone', 'status', 'create_date', 'lastvisited', 'visited', 'website')
            ->from('user');
    }
}
