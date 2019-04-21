<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller{
    //
    public function addCategory(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            if(empty($data['status'])){
                $status = 0;
            }else {
                $status = 1;
            }


            $category = new Category();

            if(empty($data['category_name'])){
                return redirect()->back()->with('flash_message_error', 'Fill required(*) fields, Category name is missing');
            }
            if(empty($data['meta_title'])){
                  $data['meta_title'] = "";
              }
              if(empty($data['meta_keyword'])){
                  $data['meta_keyword'] = "";
              }
              if(empty($data['meta_description'])){
                  $data['meta_description'] = "";
              }

            $category->name = $data['category_name'];

            $category->parent_id = $data['parent_id'];

            $category->description = $data['description'];
            $category->meta_title = $data['meta_title'];
            $category->meta_keyword = $data['meta_keyword'];
            $category->meta_description = $data['meta_description'];
            $category->url = $data['url'];
            $category->status = $status;

            //check if category already exists
            $categoryCheck= Category::where('name', $category->name)
                                     ->first();
                if($categoryCheck){
                    //if category alredy exists
                    return redirect('/admin/add_category')->with('flash_message_error', 'category already exists');
                }
            $category->save();

            return redirect('/admin/view_categories')->with('flash_message_success', 'Category added Successfully');
        }

        $levels = Category::where(['parent_id'=>0])->get();

        return view('admin.categories.add_category')->with(compact('levels'));
    }

    public function viewCategories(){
        $categories = Category::get();
        return view('admin.categories.view_categories')->with(compact('categories'));

    }

    public function editCategory(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();

            if(empty($data['status'])){
                $status = 0;
            }else {
                $status = 1;
            }

            Category::where(['id'=>$id])->update([
                                        'name'=>$data['category_name'],
                                        'description'=>$data['description'],
                                        'meta_title'=>$data['meta_title'],
                                        'meta_keyword'=>$data['meta_keyword'],
                                        'meta_description'=>$data['meta_description'],
                                        'url'=>$data['url'],
                                        'status'=>$status,
                                    ]);
            return redirect('/admin/view_categories')->with('flash_message_success', 'Category updated Successfully');
        }
        $categoryDetails = Category::where(['id'=>$id])->first();
        $levels = Category::where(['parent_id'=>0])->get();

        return view('admin.categories.edit_category')->with(compact('categoryDetails', 'levels'));
    }

    public function deleteCategory($id = null){
        if(!empty($id)){
            Category::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Category deleted successfully');
        }

    }

    public function sideBarCategories(){

        $categories = Category::get();
        return view('layouts.frontLayout.front_sidebar')->with(compact('categories'));
    }

}
