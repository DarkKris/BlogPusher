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
    public function anew()
    {
        $taglist = model('article')->gettaglist('key');
        $this->assign('taglist',$taglist);
        return view('index/new');
    }

    public function getlist()
    {
//        echo 'test';
        $alist = model('Article')->read_all();
        $this->assign("alist",$alist);
        return view('index/alist');
    }

    public function tag()
    {
        $tag = model('article')->gettaglist();
        $this->assign('taglist',$tag);
        return view('index/tag');
    }

    public function create()
    {

    }

    public function achange()
    {

    }

    public function uploadimg()
    {

    }
}
?>