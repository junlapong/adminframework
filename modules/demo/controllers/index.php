<?php
/**
 * @filesource modules/demo/controllers/index.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Demo\Index;

use Kotchasan\Html;
use Kotchasan\Http\Request;
use Kotchasan\Language;
use Kotchasan\Template;

/**
 * module=demo&page=xxx.
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Controller extends \Gcms\Controller
{
    /**
     * Controller สำหรับคัดเลือกหน้าของโมดูล demo.
     *
     * @param Request $request
     *
     * @return string
     */
    public function render(Request $request)
    {
        // ข้อความ title bar
        $this->title = Language::get('Admin Framework');
        // เลือกเมนู
        $this->menu = 'demo';
        // รับค่าจาก $_REQUEST['page'] เฉพาะตัวอักษร a-z
        $page = $request->request('page')->filter('a-z');
        if (class_exists('Demo\\'.ucfirst($page).'\View')) {
            // class View
            $template = createClass('Demo\\'.ucfirst($page).'\\View');
        } elseif (is_file(ROOT_PATH.'modules/demo/views/'.$page.'.html')) {
            // โหลดไฟล์ HTML จาก View
            $template = Template::createFromFile(ROOT_PATH.'modules/demo/views/'.$page.'.html');
        }
        if (isset($template)) {
            // แสดงผล
            $section = Html::create('section', array(
                'class' => 'content_bg',
            ));
            // breadcrumbs
            $breadcrumbs = $section->add('div', array(
                'class' => 'breadcrumbs',
            ));
            $ul = $breadcrumbs->add('ul');
            $ul->appendChild('<li><span class="icon-home">{LNG_Home}</span></li>');
            $section->add('header', array(
                'innerHTML' => '<h2 class="icon-template">'.$this->title.'</h2>',
            ));
            // คืนค่า HTML
            $section->appendChild($template->render($request));

            return $section->render();
        }
        // 404.html

        return \Index\Error\Controller::page404();
    }
}
