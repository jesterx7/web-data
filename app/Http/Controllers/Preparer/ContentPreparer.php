<?php

namespace App\Http\Controllers\Preparer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentPreparer extends Controller
{
    private static $CHINESE_WORD = [
        'Close'             => 'Close / 关',
        'Open'              => 'Open / 开',
        'Division'          => 'Division / 阶段',
        'Leader'            => 'Leader / 组长',
        'Staff'             => 'Staff / 员工账号',
        'Close Date'        => 'Close Date / 截止日期',
        'Open Date'         => 'Open Date / 开馆日',
        'Latest Open'       => 'Latest Open / 今天开的账号',
        'Latest Close'      => 'Latest Close / 今天关的账号',
    ];

    public static function addChineseCharacterToFilter(array $words)
    {
        foreach ($words as $key => $word) {
            if (array_search($word['name'], array_keys(static::$CHINESE_WORD))) {
                $words[$key]['name'] = static::$CHINESE_WORD[$word['name']];
            }
        }
        
        return $words;
    }

    public static function addChineseCharacterToHead(array $words)
    {
        foreach ($words as $key => $word) {
            if (array_search($word, array_keys(static::$CHINESE_WORD))) {
                $words[$key] = static::$CHINESE_WORD[$word];
            }
        }
        
        return $words;
    }
}
