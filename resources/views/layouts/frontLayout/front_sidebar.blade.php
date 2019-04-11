<div class="left-sidebar">
    <h2>Category</h2>
    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
        <div class="panel panel-default">
            @foreach($categories as $category)
                @if($category->status == "1")
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#{{ $category->id }}">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            {{ $category->name }}
                        </a>
                    </h4>
                </div>
                @endif
            
            <div id="{{ $category->id }}" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul>
                        @foreach($category->categories as $subcat)
                            @if($subcat->status == "1")
                            <li><a href="{{url('/products/'.$subcat->url)}}">{{ $subcat->name }} </a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
        
    </div><!--/category-products-->

</div>
