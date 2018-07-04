<?php
/**
 * @filesource modules/demo/models/upload.php
 *
 * @see http://www.kotchasan.com/
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 */

namespace Demo\Upload;

use Gcms\Login;
use Kotchasan\Http\Request;
use Kotchasan\Language;

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
     * รับค่าจากฟอร์ม (form.php).
     *
     * @param Request $request
     */
    public function submit(Request $request)
    {
        $ret = array();
        // session, token, member
        if ($request->initSession() && $request->isSafe() && $login = Login::isMember()) {
            // รับค่าจากการ POST
            $upload = array(
                'id' => $request->post('id')->toInt(),
            );
            // อัปโหลดไฟล์
            foreach ($request->getUploadedFiles() as $item => $file) {
                $input = $item === 'image_upload' ? 'image_upload' : 'pdf_uploads';
                /* @var $file UploadedFile */
                if ($file->hasUploadFile()) {
                    // ตรวจสอบนามสกุลของไฟล์
                    if (!$file->validFileExt(($input == 'image_upload' ? array('jpg', 'jpeg', 'gif', 'png') : array('pdf')))) {
                        // ชนิดของไฟล์ไม่ถูกต้อง
                        $ret['ret_' . $input] = Language::get('The type of file is invalid');
                    } else {
                        try {
                            // อัปโหลดไฟล์ไปยังปลายทาง
                            //$file->moveTo(ROOT_PATH.DATA_FOLDER.$file->getClientFilename().'.'.$file->getClientFileExt());
                            // ตัวอย่างคืนค่าข้อมูลที่อัปดหลด
                            $upload[$input][$item] = array(
                                'name' => $file->getClientFilename(),
                                'ext' => $file->getClientFileExt(),
                                'size' => $file->getSize(),
                                'mime' => $file->getClientMediaType(),
                                //'temp_name' => $file->getTempFileName()
                            );
                        } catch (\Exception $exc) {
                            // ข้อผิดพลาดการอัปโหลด
                            $ret['ret_' . $input] = Language::get($exc->getMessage());
                        }
                    }
                } elseif ($file->hasError()) {
                    // ข้อผิดพลาดการอัปโหลด
                    $ret['ret_' . $input] = Language::get($file->getErrorMessage());
                }
            }
            if (empty($ret)) {
                // คืนค่าข้อมูลที่อัปโหลดไปแสดงผล
                $ret['uploadResult'] = var_export($upload, true);
                // คืนค่า
                $ret['alert'] = Language::get('Uploaded complete');
                // โหลดหน้าเว็บใหม่
                //$ret['location'] = 'reload';
                // เคลียร์ Token ด้วย ถ้าอัปโหลดสำเร็จ ป้องกันการกดปุ่มอัปโหลดซ้ำ
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
