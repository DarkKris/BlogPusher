<?php
/**
 * Created by PhpStorm.
 * User: DarkKris
 * Date: 2018/1/21
 * Time: 下午8:52
 */

namespace app\index\Controller;

use think\Controller;

class Crawler extends Controller{
    public function work($url='https://web.umeng.com/main.php?c=site&a=frame&siteid=1262729849')
    {
        $content = file_get_contents($url);
        echo $content;
    }
}

?>