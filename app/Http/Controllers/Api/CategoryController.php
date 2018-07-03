<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function index(){
        $nodes = Category::get()->toTree();
        return $this->arrayResponse($nodes);
    }
}
