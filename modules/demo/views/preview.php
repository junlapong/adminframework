<?php
/**
 * @filesource modules/demo/views/preview.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Demo\Preview;

use Kotchasan\Html;
use Kotchasan\Http\Request;

/**
 * module=editprofile.
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class View extends \Gcms\View
{
    /**
     * ตัวอย่างฟอร์ม
     *
     * @return string
     */
    public function render(Request $request)
    {
        $form = Html::create('form', array(
            'id' => 'setup_frm',
            'class' => 'setup_frm',
            'autocomplete' => 'off',
            'action' => 'index.php/demo/model/preview/submit',
            'onsubmit' => 'doFormSubmit',
            'ajax' => true,
            'token' => true,
        ));
        $fieldset = $form->add('fieldset', array(
            'title' => '{LNG_Login information}',
        ));
        $fieldset->add('text', array(
            'id' => 'register_username',
            'itemClass' => 'item',
            'labelClass' => 'g-input icon-email',
            'label' => '{LNG_Email}',
            'comment' => '{LNG_Email address used for login or request a new password}',
            'maxlength' => 50,
            'value' => $request->post('action')->toString(),
        ));
        $fieldset = $form->add('fieldset', array(
            'class' => 'submit',
        ));
        /* ปุ่ม submit */
        $fieldset->add('submit', array(
            'class' => 'button save large',
            'value' => '{LNG_Save}',
        ));
        /* input ชนิด hidden */
        $fieldset->add('hidden', array(
            'id' => 'register_id',
            'value' => $request->post('id')->toInt(),
        ));

        return $form->render();
    }
}
