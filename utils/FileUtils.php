<?php

/**
 * Created by PhpStorm.
 * User: Li_Jing
 * Date: 2017/4/24
 * Time: 23:58
 */
class FileUtils
{
    static function getJSONInfo($file, $type)
    {
        $json_string = file_get_contents($file);
        $data = json_decode($json_string, true);
        switch($type)
        {
            case 'destination':
                $count_json = count($data['provincesList']);
                for($i = 0; $i < $count_json; $i++)
                {
                    $name_first[$i]['label'] = $data['provincesList'][$i]['Name'];
                    $name_first[$i]['value'] = $data['provincesList'][$i]['Id'];
                    $count_name = count($data['provincesList'][$i]['Citys']);
                    for ($j = 0; $j < $count_name; $j++)
                    {
                        $name_first[$i]['children'][$j]['value'] = $data['provincesList'][$i]['Citys'][$j]['Id'];
                        $name_first[$i]['children'][$j]['label'] = $data['provincesList'][$i]['Citys'][$j]['Name'];
                    }
                }
                return $name_first;
                break;
        }
    }
}