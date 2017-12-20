<?php
/**
 * Created by PhpStorm.
 * User: DarkKris
 * Date: 2017/12/17
 * Time: 下午12:45
 */
namespace app\index\Controller;

use think\Controller;

class Article extends Controller
{
    public function new()
    {
        $taglist = ['0','2'];
        $this->assign('taglist',$taglist);
        return view('index/new');
    }

    public function getlist()
    {
        return view('index/alist');
    }

    public function tag()
    {
        return view('index/tag');
    }

    public function create()
    {

    }
}
?>