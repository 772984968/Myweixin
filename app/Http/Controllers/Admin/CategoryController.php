<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends BaseController
{
    protected  $model;

    public function __construct(Category $category)
    {
        $this->model=$category;
    }


    public function index(Request $request)
    {

            $nodes = Category::get()->toTree();
            return view('admin.category.index',compact('nodes'));
    }


    public function create(Request $request)
    {
        if ($request->has('id')){
            $category=Category::find($request->input('id'));
                  return view('admin/category/create',compact('category'));
        }
        return view('admin/category/create');
    }


    public function store(Request $request)
    {
        $data=$this->checkValidate($request,[
            'name'=>'required|unique:categories,name',
        ],[
            'name.required'=>'名称必须',
            'name.unique'=>'已存在该分类',
        ]);
        if ($data!==true) {
            return response()->json(['code' => 400, 'msg' => $data]);
        }

        $model=$this->model;
        $model->fill($request->all());
        if ($model->save()){
            return response()->json(['code' => 200, 'msg' => '添加成功']);
        }else{
            return response()->json(['code' => 400, 'msg' => '添加失败']);
        }

    }

    public function show(Request $request,$id=null)
    {

        $data['title'] = $this->getTitle();
        if ($request->ajax()){
            return $this->getData($request,$id);
        }
        $category=Category::find($id);

        return view('admin.category.show', compact('data','category'));
    }

    public function edit($id)
    {
        $category=Category::find($id);

        return view('admin.category.edit',compact('category'));
    }


    public function update(Request $request, $id)
    {
        $data=$this->checkValidate($request,[
            'name'=>'required|unique:categories,name',
        ],[
            'name.required'=>'名称必须',
            'name.unique'=>'已存在该分类',
        ]);
        if ($data!==true) {
            return response()->json(['code' => 400, 'msg' => $data]);
        }
        $model=Category::findOrFail($id);
        $model->fill($request->all());
        if ($model->save()){
            return response()->json(['code' => 200, 'msg' => '修改成功']);
        }else{
            return response()->json(['code' => 400, 'msg' => '修改失败']);
        }
    }

    public function destroy($id)
    {
       if ($this->model::destroy($id)){
            return response()->json(['code'=>200,'msg'=>'删除成功']);
        }else{

            return response()->json(['code'=>400,'msg'=>'删除失败']);
        }
    }

    public function getTitle()
    {
        return [[
            ['type' => 'checkbox'],
            ['field' => 'id', 'title' => 'ID', 'sort' => 'true'],
            ['field' => 'name', 'title' => '名称'],
            ['field' => 'sort', 'title' => '排序','sort'=>'true'],
            ['field' => 'right', 'title' => '数据操作', 'align' => 'center', 'toolbar' => '#barDemo', 'width' => 300]
        ]];
    }

    public function getData(Request $request,$id)
    {
        $model = $this->model;
        $limit = $request->limit ?? '10';
        if ($id) {

                 $sql = $model->where('parent_id',$id);
        }else{

            $sql=$model->where('parent_id',null);
        }
        $count = $sql->count();
        $paginate = $sql->paginate($limit);
        $data = $paginate->toArray();
        return $data = ['code' => 0, 'msg' => '', 'count' => $count, 'data' => $data['data']];
    }
    //查看详情
    public function detail(Request $request){

        $id=$request->input('id');
        $category=Category::find($id);
        return view('admin.category.detail',compact('category'));
    }
public function getCategory(Request $request){
    $id=$request->input('pid');
    $rs=Category::getSonCategory($id);
  if ($rs){
    return   $this->json($rs,200,'success');
    }
    return $this->json();
}

}
