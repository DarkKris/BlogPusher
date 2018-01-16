<?php
/**
 * Created by PhpStorm.
 * User: DarkKris
 * Date: 2017/12/23
 * Time: 上午9:57
 */
namespace app\index\Model;

use think\Model;

class Article extends Model
{
    public function read_all()
    {
        $dir = '/Users/wdhhdzyhb/darkkris.github.io/_posts';
        $ignore = '.DS_Store';
        if (!is_dir($dir)) return false;

        $handle = opendir($dir);
        $afiles = array();
        $p = 0;

        if ($handle) {
            while (($fl = readdir($handle)) !== false) {
                $temp = $dir . DIRECTORY_SEPARATOR . $fl;
                if ($fl != '.' && $fl != '..' && $fl != $ignore) {
                    // 处理文件
                    $afiles[++$p] = $this->filework($temp);
                }
            }
        }
//        var_dump($afiles);
            return $afiles;
    }

    private function filework($temp)
    {
        $myfile = fopen($temp, "r");
        $article = fread($myfile, filesize($temp));

        /*
         * title: "xxxxxxx"
         * date: xxxx-xx-xx
         * description: "xxxx,xxxx,xxx"
         * tag: xxxxxx
         */

        $titlestr = strpos($article, 'title: "') + 8;
        $datestr = strpos($article, "date: ") + 6;
        $desstr = strpos($article, "description: ") + 14;
        $tagstr = strpos($article, "tag: ") + 5;

        for ($i = $titlestr; $article[$i] != '"'; $i++) ;
        $titleend = $i - 1;
        for ($i = $datestr; $article[$i] != 'd'; $i++) ;
        $dateend = $i - 2;
        for ($i = $desstr; $article[$i] != '"'; $i++) ;
        $desend = $i - 1;
        for ($i = $tagstr; $article[$i] != '-'; $i++) ;
        $tagend = $i - 2;

        $title = substr($article, $titlestr, $titleend - $titlestr + 1);
        $date = substr($article, $datestr, $dateend - $datestr);
        $description = substr($article, $desstr, $desend - $desstr + 1);
        $tag = substr($article, $tagstr, $tagend - $tagstr + 1);

        $ret = array([
            "title" => $title,
            "date" => $date,
            "description" => $description,
            "tag" => $tag,
            "src" => $temp
        ]);

        return $ret;
    }

    public function gettaglist($mod='normal')
    {
        $data = $this->read_all();
        $tag = array();
        foreach ($data as $key => $value)
        {
            if(!isset($tag[$value[0]["tag"]])) {
                $tag[$value[0]["tag"]] = 0;
            }
            $tag[$value[0]["tag"]]++;
        }
        if($mod=='normal')
            return $tag;
        else
            return array_keys($tag);
    }
}

?>