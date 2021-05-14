<?php

namespace App\Http\Controllers\Preparer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentPreparer extends Controller
{
    public static function addChineseCharacter(array $words)
    {
        $CHINESE_WORD = [
            'Close'             => 'Close / 关',
            'Open'              => 'Open / 开',
            'Division'          => 'Division / 阶段',
            'Leader'            => 'Leader / 组长',
            'Staff'             => 'Staff / 员工账号',
            'Close Date'        => 'Close Date / 截止日期',
            'Open Date'         => 'Open Date / 开馆日',
            'Lastest Open'      => 'Lastest Open / 今天开的账号',
            'Lastest Close'     => 'Lastest Close / 今天关的账号',
        ];

        foreach ($words as $key => $word) {
            if (array_search($word, array_keys($CHINESE_WORD))) {
                $words[$key] = $CHINESE_WORD[$word];
            }
        }
        
        return $words;
    }
}
