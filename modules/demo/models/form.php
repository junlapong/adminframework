<?php
/**
 * @filesource modules/demo/models/form.php
 * @link http://www.kotchasan.com/
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 */

namespace Demo\Form;

use \Gcms\Login;
use \Kotchasan\Http\Request;
use \Kotchasan\Language;

/**
 * รับค่าจากฟอร์ม
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Model extends \Kotchasan\Model
{

    /**
     * รับค่าจากฟอร์ม (form.php)
     *
     * @param Request $request
     */
    public function submit(Request $request)
    {
        $ret = array();
        // session, token, member
        if ($request->initSession() && $request->isSafe() && $login = Login::isMember()) {
            // รับค่าจากการ POST
            $save = array(
                'username' => $request->post('register_username')->username(),
                'password' => $request->post('register_password')->password(),
                'repassword' => $request->post('register_repassword')->password(),
                'date' => $request->post('register_date')->date(),
                'time' => $request->post('register_time')->date(),
                'amount' => $request->post('register_amount')->toDouble(),
                'color1' => $request->post('register_color1')->filter('0-9A-Z\#'),
                'phone' => $request->post('register_phone')->number(),
                'color2' => $request->post('register_color2')->filter('0-9A-Z\#'),
                'sex' => $request->post('register_sex')->filter('fm'),
                'sex' => $request->post('register_sex')->filter('fm'),
                'address' => $request->post('register_address')->textarea(),
                'url' => $request->post('register_url')->url(),
                'email' => $request->post('register_email')->url(),
                'provinceID' => $request->post('register_provinceID')->number(),
                'zipcode' => $request->post('register_zipcode')->number(),
                'permission' => $request->post('register_permission', array())->topic(),
                'fb' => $request->post('register_fb', array())->toInt(),
                'id' => $request->post('register_id')->toInt(),
            );
            // ดูค่าที่ส่งมา
            //print_r($_POST);
            //print_r($save);
            if ($save['username'] == '') {
                $ret['ret_register_username'] = 'Please fill in';
            }
            if (empty($ret)) {
                // บันทึกลงฐานข้อมูล
                //$this->db()->update($this->getTableName('user'), $save['id'], $save);
                // คืนค่า
                $ret['alert'] = Language::get('Saved successfully');
                // ไปหน้าแสดงรายการข้อมูล
                $ret['location'] = $request->getUri()->postBack('index.php', array('module' => 'demo-table', 'id' => null));
                // เคลียร์
                $request->removeToken();
            }
        }
        if (empty($ret)) {
            $ret['alert'] = Language::get('Unable to complete the transaction');
        }
        // คืนค่าเป็น JSON
        echo json_encode($ret);
    }
}
