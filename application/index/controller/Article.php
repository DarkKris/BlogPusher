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

    public function achange($tempsrc)
    {
        $tag = model('article')->gettaglist();
        $this->assign('taglist',$tag);
        $this->assign('data',model('Article')->filework($tempsrc));
        return view('index/change');
    }

    public function uploadimg()
    {

    }

    public function savearticle($data)
    {
        /*
         * title: "xxxxxxx"
         * date: xxxx-xx-xx
         * description: "xxxx,xxxx,xxx"
         * tag: xxxxxx
         */

        $dir='/Applications/MAMP/htdocs/BlogPusher/public/static/save/save.md';
        $myfile=fopen($dir,"w");
        $articlecontent="---\nlayout: post\ntitle: \"".$data['title']."\"\ndate: ".$data['year']."-".$data['month']."-".$data['day']." \ndescription: \"".$data['des']."\"\ntag: ".$data['tag']."\n---\n\n".$data['content'];
        fwrite($myfile,$articlecontent);
        fclose($myfile);
    }

    public function autosavearticle($title,$year,$month,$day,$des,$tag,$content)
    {
        /*
         * title: "xxxxxxx"
         * date: xxxx-xx-xx
         * description: "xxxx,xxxx,xxx"
         * tag: xxxxxx
         */

        $dir='/Applications/MAMP/htdocs/BlogPusher/public/static/save/save.md';
        $myfile=fopen($dir,"w");
        $articlecontent="---\nlayout: post\ntitle: \"".$title."\"\ndate: ".$year."-".$month."-".$day." \ndescription: \"".$des."\"\ntag: ".$tag."\n---\n\n".$content;
        fwrite($myfile,$articlecontent);
        fclose($myfile);
    }

    public function create()
    {
        $data=array(
            'title'=>input('get.title'),
            'des'=>input('get.des'),
            'year'=>input('get.year'),
            'month'=>input('get.month'),
            'day'=>input('get.day'),
            'tag'=>input('get.selector'),
            'content'=>input('get.content')
        );
        if($data['tag']=="New..")
        {
            $data['tag']=input("post.newtag");
        }
        $this->savearticle($data);
        $articlename=$data['year']."-".$data['month']."-".$data['day']."-".$data['title'].".md";
        //将文件移动至/Users/wdhhdzyhb/darkkris.github.io/_posts并删除文件
        copy('/Applications/MAMP/htdocs/BlogPusher/public/static/save/save.md',"/Users/wdhhdzyhb/darkkris.github.io/_posts/$articlename");
        unlink('/Applications/MAMP/htdocs/BlogPusher/public/static/save/save.md');

        //cd darkkris.github.io
        //git add _posts/$articlename
        //git commit -m “发布新文章”
        //git push origingit master
        exec("cd /Users/wdhhdzyhb/darkkris.github.io;git add _posts/$articlename;git commit -m \"发布新文章\";git push origingit master;");

        $this->assign('title',$data['title']);
        $this->assign('content',mb_substr($data['content'],0,50));
        $this->assign('url',"https://darkkris.github.io/".$data['year']."/".$data['month']."/".$articlename);
        return view("index/success");
    }
}
?>