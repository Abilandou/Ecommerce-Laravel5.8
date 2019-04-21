@extends('layouts.adminLayout.admin_design')
@section('content')


<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> <a href="/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">
   Products</a> <a href="#" class="current">view Products</a>
  </div>

    <h1>Products</h1>
    @if(Session::has('flash_message_error'))
      <div class="alert alert-error alert-block">
          <button type="button" class="close" data-dismiss="alert">x</button>
              <strong>{!! session('flash_message_error') !!}</strong>
      </div>
    @endif
    @if(Session::has('flash_message_success'))
      <div class="alert alert-error alert-block">
          <button type="button" class="close" data-dismiss="alert">x</button>
              <strong>{!! session('flash_message_success') !!}</strong>
      </div>
    @endif
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Products</h5><a href="/admin/add_cms_page" style="margin-left:65%; margin-top:2px;"  class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>Add Cms Page</a>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                    <th>Page ID</th>
                    <th>status</th>
                    <th>Page Title</th>
                    <th>Page Url</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allPages as $page)
                    <tr class="gradeX">
                        <td>{{ $page->id }}</td>
                        <td>
                            <?php
                              if($page->status =="1") {
                               echo "Published";
                              }else{
                                echo "Not Published";
                              }
                            ?>
                        </td>

                        <td>{{ $page->title }}</td>
                        <td>{{ $page->url }}</td>
                        <td class="center">
                            <a href="#myModal{{ $page->id }}" data-toggle="modal" class="btn btn-success btn-mini" title="See Page's Complete Imformation">view</a>
                            <a href="{{ url('admin/edit_cms_page/'.$page->id) }}" class="btn btn-primary btn-mini" title="Edit This Page">Edit</a>
                            <a rel="{{ $page->id }}" rel1="delete_cms_page" href="javascript:" <?php /*href="{{ url('admin/delete_cms_page/'.$page->id) }}"*/?>
                               class="btn btn-danger btn-mini deleteRecord" title="Delete This page">Delete</a>
                        </td>
                    </tr>
                    <div id="myModal{{ $page->id }}" class="modal hide">
                        <div class="modal-header">
                            <button data-dismiss="modal" class="close" type="button">×</button>
                            <h3 style="display:margin-left:50%;"> View Details For: {{ $page->title }}.</h3>
                        </div>
                        <div class="modal-body">
                        <p><b>page ID:</b> {{ $page->id }}</p>
                        <p><b>Page Status</b>
                            <?php
                              if($page->status =="1") {
                               echo "Published";
                              }else{
                                echo "Not Published";
                              }
                            ?>
                        </p>
                        <p><b>Page Title:</b> {{ $page->title }}</p>
                        <p><b>Page Url:</b> {{ $page->url }}</p>
                        <p><b>Meta Title:</b> {{ $page->meta_title }}</p>
                        <p><b>Meta Keyword:</b> {{ $page->meta_keyword }}</p>
                        <p><b>Meta Description(Body):</b> {{ $page->meta_description }}</p>
                        <p><b>Page Title:</b> {{ $page->title }}</p>
                        <p><b>Sub Title One:</b> {{ $page->sub_title_one }}</p>
                        <p><b>Page Description(Body one):</b> {{ $page->description }}</p>
                        <p><b>Sub Title Two:</b> {{ $page->sub_title_two }}</p>
                        <p><b>Page Description(Body Two):</b> {{ $page->content_two }}</p>
                        <p><b>Sub Title Three:</b> {{ $page->sub_title_three }}</p>
                        <p><b>Page Description(Body Three):</b> {{ $page->content_three }}</p>
                        
                        </div>
                    </div>

                    @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>



</div>
@endsection

