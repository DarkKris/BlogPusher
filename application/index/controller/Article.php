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

    public function achange()
    {

    }

    public function read_all ()
    {
        $dir = '/Users/wdhhdzyhb/darkkris.github.io/_posts';
        $ignore = '.DS_Store';
        if(!is_dir($dir)) return false;

        $handle = opendir($dir);

        if($handle){
            while(($fl = readdir($handle)) !== false){
                $temp = $dir.DIRECTORY_SEPARATOR.$fl;
//                如果不加  $fl!='.' && $fl != '..'  则会造成把$dir的父级目录也读取出来
//                if(is_dir($temp) && $fl!='.' && $fl != '..'){
//                    echo '目录：'.$temp.'<br>';
//                    read_all($temp);
//                }else{
                if($fl!='.' && $fl != '..' && $fl != $ignore)
                {
                    echo '文件：'.$temp.'<br>';
                }
//                }
            }
        }
    }
}
?>