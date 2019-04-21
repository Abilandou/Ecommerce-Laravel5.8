<?php

namespace App\Http\Controllers;

use App\CmsPage;
use App\Category;
use Validator;

use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class CmsPagesController extends Controller
{
    //
    public function addCmsPage(Request $request){
        if($request->isMethod('post')){
           $data = $request->all();

          $cmsPage = new CmsPage();

          if(empty($data['meta_title'])){
              $data['meta_title'] = "";
          }
          if(empty($data['meta_keyword'])){
              $data['meta_keyword'] = "";
          }
          if(empty($data['meta_description'])){
              $data['meta_description'] = "";
          }

          $cmsPage->title = $data['title'];
          $cmsPage->url = $data['url'];
          $cmsPage->meta_title = $data['meta_title'];
          $cmsPage->meta_keyword = $data['meta_keyword'];
          $cmsPage->meta_description = $data['meta_description'];
          $cmsPage->sub_title_one = $data['sub_title_one'];
          $cmsPage->description = $data['description'];
          $cmsPage->sub_title_two = $data['sub_title_two'];
          $cmsPage->content_two = $data['content_two'];
          $cmsPage->sub_title_three = $data['sub_title_three'];
          $cmsPage->content_three = $data['content_three'];


          if(empty($data['status'])){
              $status = 0;
          }else{
              $status = 1;
          }
          $cmsPage->status = $status;


          //check if Page Title already exists
          $pageTitleCheck= CmsPage::where('title', $cmsPage->title)
                                   ->first();
              if($pageTitleCheck){
                  //if category alredy exists
                  return redirect('/admin/add_cms_page')->with('flash_message_error', 'page title already exists');
              }

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
                                        'url'=>$data['url'],
                                        'meta_title'=>$data['meta_title'],
                                        'meta_keyword'=>$data['meta_keyword'],
                                        'meta_description'=>$data['meta_description'],
                                        'sub_title_one'=>$data['sub_title_one'],
                                        'description'=>$data['description'],
                                        'sub_title_two'=>$data['sub_title_two'],
                                        'content_two'=>$data['content_two'],
                                        'sub_title_three'=>$data['sub_title_three'],
                                        'content_three'=>$data['content_three'],
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

    public function CmsPage($url){

        //Get pages with enabled status only(status=1)
        $cmsPageCount = CmsPage::where(['url'=>$url, 'status'=>1])->count();
        if($cmsPageCount > 0){
            //Get page details
            $cmsPageDetails = CmsPage::where('url', $url)->first();
            $meta_title = $cmsPageDetails->meta_title;
            $meta_description = $cmsPageDetails->meta_description;
            $meta_keyword = $cmsPageDetails->meta_keyword;
        }
        else{
            abort(404);
        }

        



        //Get all categories
        $categories = Category::where('parent_id', '0')->get();

        return view('pages.cms_page')->with(compact('cmsPageDetails', 'categories', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function contactUs(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            //Perform some validations in laravel 5.8
                //either use alpha or regex:/^[\pL\s\-]+$/u to exclude numbers.
                $validateData = Validator::make($request->all(), [
                    'name' => 'required|alpha|max:255',
                    'email' => 'required|email',
                    'subject'=> 'required',
                    'user_message' => 'required'

                ]);

                if($validateData->fails()){
                    return redirect()->back()->withErrors($validateData)->withInput();
                }
            //Send Contact email
            $email = "godloveabilandou@gmail.com";
            $messageData = [

                'name'=>$data['name'],
                'email'=>$data['email'],
                'subject'=>$data['subject'],
                'user_message'=>$data['user_message']

            ];
            Mail::send('emails.enquiry', $messageData, function ($message) use($email) {

                $message->to($email)->subject('Contact Email from Ecom Site');
            });
            return redirect()->back()->with('flash_message_success', 'Thanks for contacting us we will be in touch');


            //Verify email submition
            if( count(Mail::failures()) > 0 ) {
                echo "Failure in sending New Password. Some problems can be: <br />";

                foreach(Mail::failures() as $email) {
                    echo " - $email <br />";
                }

            }else{
                return redirect()->back()->with('flash_message_success', 'Thanks for contacting us we will be in touch');
            }//Send email reset password ends here

        }
        //Meta tags
        $meta_title = "Contact-My Ecom site";
        //Meta description
        $meta_description = "THe description of your site goes here";
         //Add key words to uniquely identify your site
        $meta_key_word = "Contact us NameOfSite";

        return view('pages.contact_us')->with(compact('meta_title', 'meta_description', 'meta_key_word'));
    }
}
