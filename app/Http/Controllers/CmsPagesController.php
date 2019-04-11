<?php

namespace App\Http\Controllers;

use App\CmsPage;

use Illuminate\Http\Request;

class CmsPagesController extends Controller
{
    //
    public function addCmsPage(Request $request){
        if($request->isMethod('post')){
           $data = $request->all(); 

          $cmsPage = new CmsPage();

          $cmsPage->title = $data['title'];
          $cmsPage->url = $data['url'];
          $cmsPage->description = $data['description'];

          if(empty($data['status'])){
              $status = 0;
          }else{
              $status = 1;
          }
          $cmsPage->status = $status;
          $cmsPage->save();
          return redirect('/admin/view_cms_pages')->with('flash_message_success', 'CMS Page added Successfully');
        }
        return view('admin.pages.add_cms_page');
    }

    public function viewCmsPages(){
        $allPages = CmsPage::get();
        return view('admin.pages.view_cms_pages')->with(compact('allPages'));

    }

    public function editCmsPage(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();

            if(empty($data['status'])){
                $status = 0;
            }else {
                $status = 1;
            }

            CmsPage::where(['id'=>$id])->update([
                                        'title'=>$data['title'],
                                        'description'=>$data['description'],
                                        'url'=>$data['url'],
                                        'status'=>$status,
                                    ]);
            return redirect('/admin/view_cms_pages')->with('flash_message_success', 'Cms Page updated Successfully'); 
        }
        $cmsPageDetails = CmsPage::where(['id'=>$id])->first();

        return view('admin.pages.edit_cms_page')->with(compact('cmsPageDetails'));
    }

    public function deleteCmsPage($id = null){
        if(!empty($id)){
            CmsPage::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Cms Page deleted successfully');
        }

    }
}
