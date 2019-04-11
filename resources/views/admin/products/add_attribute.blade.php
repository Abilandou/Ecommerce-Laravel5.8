@extends('layouts.adminLayout.admin_design')
@section('content')



<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">products</a> <a href="#" class="current">Add product Attributes</a> </div>
    <h1>Product Attributes</h1>
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
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">

        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Attribute</h5>
          </div>

          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal " method="post" action="{{ url('/admin/add_attribute/'.$productDetails->id) }}" name="add_attribute" id="add_attribute">
                {{ csrf_field() }}
              <div class="control-group">
                <input type="hidden" name="product_id" value="{{ $productDetails->id }}" />
              </div>
              
              <div class="control-group">
                <label class="control-label">Product Name</label>
                <label class="control-label"><strong>{{ $productDetails->product_name }}</strong></label>
              </div>

              <div class="control-group">
                <label class="control-label">Product Code</label>
                <label class="control-label"><strong>{{ $productDetails->product_code }}</strong></label>
              </div>

              <div class="control-group">
                <label class="control-label">Product Color</label>
                <label class="control-label"><strong>{{ $productDetails->product_color }}</strong></label>
              </div>

              <div class="control-group">
                <label class="control-label"></label>
                <div class="field_wrapper">
                    <div>
                    <div><hr/>
                        <i style="margin-left:375px; ">Attributes For <b style="color:hotpink"> Small size</b> of this product</i><hr/>
                        
                        <i style="margin-left:180px;">sku<input type="text"  name="sku[]" id="sku" placeholder="SkU(eg:TP01-S(S=small)" style="width:120;" /></i>
                        size<input type="text"  name="size[]" id="size" placeholder="Size" style="width:120;" />
                        price<input type="number"  min="1" max="1000000" name="price[]" id="price" placeholder="Price" style="width:120;" /><br/>
                        <i style="margin-left:170px;">stock<input type="number"  min="1" max="1000000" name="stock[]" id="stock" placeholder="Stock" style="width:120; margin-top:10px;" /></i>
                        age<input type="number"  min="1" max="1000000" name="age[]" id="age" placeholder="Age(in months)" style="width:120;  margin-top:10px;" />
                    </div>
                    <br/><hr/>
                    <div>
                        <i style="margin-left:375px;">Attributes For <b style="color:hotpink"> Medium size </b> of this product</i><hr/><br/>

                        <i style="margin-left:180px;">sku<input type="text"  name="sku[]" id="sku" placeholder="SkU(eg:TP01-M(M=Medium))" style="width:120;" /></i>
                        size<input type="text"  name="size[]" id="size" placeholder="Size" style="width:120;" />
                        price<input type="number" min="1" max="1000000"  name="price[]" id="price" placeholder="Price" style="width:120;" /><br/>
                        <i style="margin-left:170px;">stock<input type="number"  min="1" max="1000000" name="stock[]" id="stock" placeholder="Stock" style="width:120; margin-top:10px;" /></i>
                        age<input type="number" min="1" max="1000000"  name="age[]" id="age" placeholder="Age(in months)" style="width:120;  margin-top:10px;" />
                    </div>
                    <br><hr/>
                    <div>
                        <i style="margin-left:375px;">Attributes For <b style="color:hotpink"> Large size</b> of this product</i><hr/><br/>
                    
                        <i style="margin-left:180px;">sku<input type="text"  name="sku[]" id="sku" placeholder="SkU(eg:TP01-L(L=Large))" style="width:120;" /></i>
                        size<input type="text" name="size[]"  id="size" placeholder="Size" style="width:120;" />
                        price<input type="number" min="1"  max="1000000" name="price[]" id="price" placeholder="Price" style="width:120;" /><br/>
                        <i style="margin-left:170px;">stock<input type="number"  min="1" max="1000000" name="stock[]" id="stock" placeholder="Stock" style="width:120; margin-top:10px;" /></i>
                        age<input type="number" min="1" max="1000000"  name="age[]" id="age" placeholder="Age(in months)" style="width:120;  margin-top:10px;" />
                    </div>

                    {{-- <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fas fa-plus"></i>Add</a> --}}
                    </div>
                </div>
              </div>

              <div class="form-actions">
                <input type="submit" value="Add Attribute" id="add_product" class="btn btn-success ">
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Attributes</h5>
          </div>
          <div class="widget-content nopadding">
          <form action="{{url('admin/edit_attribute/'.$productDetails->id) }}" method="post">
            {{csrf_field()}}
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                    <th>Attribute ID</th>
                    <th>SkU</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Age(Months)</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productDetails['attributes'] as $attribute)
                    <tr class="gradeX">
                        <td><input type="hidden" min="1" name="idAttr[]" value="{{ $attribute->id }}">{{ $attribute->id }}</td>
                        <td>{{ $attribute->sku }}</td>
                        <td>{{ $attribute->size }}</td>
                        <td><input type="number" name="price[]" value="{{ $attribute->price }}" min="1"></td>
                        <td><input type="number" name="stock[]" value="{{ $attribute->stock }}" min="1"></td>
                        <td>{{ $attribute->age }}</td>
                        <td class="center">
                          <input type="submit" value="Update" class="btn btn-primary btn-mini">
                          <a rel="{{ $attribute->id }}" rel1="delete_attribute" href="javascript:" <?php /*href="{{ url('admin/delete_product/'.$attribute->id) }}"*/?>
                              class="btn btn-danger btn-mini deleteRecord">Delete</a>
                        </td>
                    </tr>     
                    @endforeach
              </tbody>
            </table>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection