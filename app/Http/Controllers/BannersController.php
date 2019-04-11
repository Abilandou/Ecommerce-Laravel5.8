<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use App\Banner;
use Image;
class BannersController extends Controller
{
    //
    public function addBanner(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();

            $banner = new Banner();

            $banner->title = $data['title'];
            $banner->link = $data['link'];

            // if(empty($data['status'])){
            //     $status = '0';
            // }else{
            //     $status = '1';
            // }
            // $banner->$status = $status;

             //Upload Image
            if($request->hasFile('image')){
               $image_tmp = Input::file('image');
                if($image_tmp->isValid()){

                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $banner_image_path = 'images/frontend_images/banners/'.$filename;

                    //Resize Banner Image.
                    Image::make($image_tmp)->resize(1140, 340)->save($banner_image_path);

                    //Store image name in banners table
                    $banner->image = $filename;
                }
            }
            //check if link name already exists
            $bannerCheck= Banner::where('link', $banner->link)
                                ->first();
                if($bannerCheck){
                    //if banner already exists
                    return redirect('/admin/add_banner')->with('flash_message_error', 'Banner already exists');
                }
           
            $banner->save();
            return redirect('/admin/view_banners')->with('flash_message_success', 'Banner added Successfully');

        }
        return view('admin.banners.add_banner');
    }

    public function viewBanners(){
        $banners = Banner::get();
        return view('admin.banners.view_banners')->with(compact('banners'));
    }

    public function editBanner(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['status'])){
                $status = '0';
            }else{
                $status = '1';
            }
            if(empty($data['title'])){
                $data['title'] = "";
            }
            if(empty($data['link'])){
                $data['link'] = "";
            }
            if($request->hasFile('image')){
                $image_tmp = Input::file('image');
                 if($image_tmp->isValid()){
 
                     $extension = $image_tmp->getClientOriginalExtension();
                     $filename = rand(111,99999).'.'.$extension;
                     $banner_image_path = 'images/frontend_images/banners/'.$filename;
 
                     //Resize Banner Image.
                     Image::make($image_tmp)->resize(1140, 340)->save($banner_image_path);
 
                     //Store image name in banners table
                 }
            }else if(!empty($data['current_image'])){
                $filename = $data['current_image'];
            }else{
                $filename = "";
            }
        
            Banner::where('id',$id)->update([
                'status'=>$status,
                'title'=>$data['title'],
                'link'=>$data['link'],
                'image'=>$filename
            ]);
            return redirect('/admin/view_banners')->with('flash_message_success', 'Banner updated');
      
        }
        $bannerDetails = Banner::where('id',$id)->first();
        return view('admin.banners.edit_banner')->with(compact('bannerDetails'));
    }

    public function deleteBanner($id = null){
        Banner::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_success', 'Bannner deleted successfully');
    }


}
