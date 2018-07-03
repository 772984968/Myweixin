<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedbackController extends TemplateController
{
    protected $model;
    public $config=[
        "title"=>'反馈管理',
        'index'=>'feedback.index',//首页
        'show'=>'feedback.show',//查看
        'delete'=>'feedback.destroy',//删除
    ];
    public function __construct()
    {
        $this->model= new Feedback();

    }

    function getTitle()
    {
        return[[
            ['type'=>'checkbox'],
            ['field'=>'id','title'=>'ID','sort'=>'true'],
            ['field'=>'user_id','title'=>'反馈用户'],
            ['field'=>'content','title'=>'反馈信息'],
            ['field'=>'created_at','title'=>'反馈日期'],
            ['field'=>'right','title'=>'数据操作','align'=>'center','toolbar'=>'#barDemo','width'=>300]
        ]
        ];

    }
}
