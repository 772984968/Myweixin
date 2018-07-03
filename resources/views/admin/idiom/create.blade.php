@extends('admin.layouts.admin')
{{--meta、css--}}
@section('_meta')
    @include('admin.layouts._meta')
    <link href="{{asset('admin/plugins/layui/css/layui.css')}}" rel="stylesheet">
      @endsection
{{--title--}}
@section('title', '后台管理系统')
{{--coentent 主题内容--}}
@section('content')
    <body>
    <div class="layui-container"layui-bg-gray>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>添加成语</legend>
        </fieldset>
        <form class="layui-form" action="{{route('idiom.store')}}" method="post">
            {{ csrf_field() }}
            <div class="layui-form-item">
                <label class="layui-form-label">成语</label>
                <div class="layui-input-block">
                    <input type="text" lay-verify=""  value="" name="name"
                           placeholder="" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">拼写</label>
                <div class="layui-input-block">
                    <input type="text" lay-verify=""  value="" name="spell"
                           placeholder="" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">拼音</label>
                <div class="layui-input-block">
                    <input type="text" lay-verify=""  value="" name="pinyin"
                           placeholder="" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">首字</label>
                <div class="layui-input-block">
                    <input type="text" lay-verify=""  value="" name="first_word"
                           placeholder="" autocomplete="off" class="layui-input">
                </div>

            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">尾字</label>
                <div class="layui-input-block">
                    <input type="text" lay-verify=""  value="" name="last_word"
                           placeholder="" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">近义词</label>
                <div class="layui-input-block">
                    <input type="text" lay-verify=""  value="" name="antonym"
                           placeholder="多个词请用英文逗号隔开,例如：a,b,c" autocomplete="off" class="layui-input">
                </div>

            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">反义词</label>
                <div class="layui-input-block">
                    <input type="text" lay-verify=""  value="" name="thesaurus"
                           placeholder="多个词请用英文逗号隔开,例如：a,b,c" autocomplete="off" class="layui-input">
                </div>

            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">等级</label>
                <div class="layui-input-block">

                    <select name="level_id" lay-verify="">
                        @foreach($level as $vo)
                            <option value="{{$vo->id}}">{{$vo->level}}</option>

                        @endforeach
                    </select>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">解释</label>
                <div class="layui-input-block">
                    <textarea name="explain" placeholder="请输入内容" class="layui-textarea"></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">出处</label>
                <div class="layui-input-block">
                    <textarea name="derivation" placeholder="请输入内容" class="layui-textarea"></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">例子</label>
                <div class="layui-input-block">
                    <textarea name="sample" placeholder="请输入内容" class="layui-textarea"></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">故事</label>
                <div class="layui-input-block">
                    <textarea name="story" placeholder="请输入内容" class="layui-textarea"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>

                </div>
            </div>
        </form>
    </div>
    </body>
@endsection
{{--script 代码和js--}}
@section('script')
    @include('admin.layouts._script')
    <script src="{{asset('admin/plugins/layui/layui.all.js')}}"></script>
    <script>
        layui.use('form', function(){
            var form = layui.form;
            //监听提交
            form.on('submit(formDemo)', function(formdata){
                var url=$('.layui-form').attr('action');
                $.ajax({
                    url:url,
                    type:'POST',
                    dataType:'json',
                    data:formdata.field,
                    success:function(data){
                        if(data.code=='200'){
                            layer.msg(data.msg,{icon:1,time:1*1000},function(){
                                var index = parent.layer.getFrameIndex(window.name);
                                parent.layer.close(index);
                            });
                        }else{
                            layer.msg(data.msg,{icon:5});
                        }
                    },
                    error:function(data){
                        layer.msg('数据发送失败',{icon:5});
                    }
                });
                return false;
            });
        });
    </script>
@stop
