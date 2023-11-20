@extends('admin.app')

@section('main-content')
    <section class="container">
        <div class=" d-flex shadow-sm p-2">
            <a class="btn btn-light text-muted" style="font-size:smaller" href="{{route('dashboard')}}">[Back]</a>
        </div>
        <h2 class="text-success">PRODUCTS</h2>
        <div class="row">
            <div class="col-6">
                <div class="d-flex">
                    <a class="btn btn-success" style="font-size:smaller" href="{{route('addProduct')}}">Add New</a>
                    <a class="btn btn-dark ms-auto" style="font-size:smaller" href="#bottom"><span class="">Go to Bottom</span></a>
                </div>
            </div>
            <div class="col-6 d-flex">
                <label for="" class="ms-auto">Search: <input type="text" id="searchInput" class="border rounded"></label>
            </div>
        </div>
        
        <div class="bg-light p-2">
            <table class="table table-striped shadow-sm p-2 my-3"  id="#top">
                <hr>
            <th >
                <!-- <td>NO</td> -->
                <td class="text-bold">NAME</td>
                <td class="text-bold">CATEGORY</td>
                <td class="text-bold">PROPERTIES</td>
                <td class="text-bold">STATUS</td>
                <td class="text-bold">IMAGE(S)</td>
                <td class="text-bold">ACTION</td>
            </th>            
            @foreach($products as $product)
                <tr class="text-muted tr" style="font-size:">
                    <td>{{$loop->index + 1}}</td>
                    <td class="search_param_1 text-dark"  style="font-size:normal">@if($product->botanical_name){{$product->botanical_name}}@endif @if($product->common_name)({{$product->common_name}})@endif</td>
                    <td class="search_param_2">
                        @php $cat = str_replace('_', ' ', $product->category)@endphp
                        {{$cat}} <span hidden>{{$product->category}}</span> 
                        {{-- The following is for the sake of searching based on description, it's hidden --}}
                        <span hidden> {{$product->notes}}</span>
                    </td>
                    <td class="search_param_3">
                        @if($product->light_requirement) 
                            @foreach($product->light_requirement as $req)
                            @php $light = str_replace('_', ' ', $req->requirement)@endphp
                                {{$req->requirement}}, 
                                {{-- The following is for the sake of searching based on light requirements, it's hidden --}}
                                <span hidden>{{$light}}</span>
                            @endforeach
                        @endif

                        {{-- The following is for the sake of searching based on foliage color, it's hidden --}}
                        @if($product->foliage_color) 
                            @foreach($product->foliage_color as $col)
                            @php $color = str_replace('_', ' ', $col->color)@endphp
                            <div class="" hidden>
                                {{$col->color}}, 
                                
                                <span >{{$color}}</span>
                            </div>
                            @endforeach
                        @endif

                        {{-- The following is for the sake of searching based on flower color, it's hidden --}}
                        @if($product->flower_color) 
                            @foreach($product->flower_color as $col)
                            @php $color = str_replace('_', ' ', $col->color)@endphp
                            <div class="" hidden>
                                {{$col->color}}, 
                                
                                <span >{{$color}}</span>
                            </div>
                            @endforeach
                        @endif

                        @if(strlen($product->maintenance) > 0) 
                            <span> {{$product->maintenance}} maintenance,</span>
                        @endif

                        @if(strlen($product->water_requirements) > 0) 
                            <span> {{$product->water_requirements}} watering</span>
                        @endif
                    </td>
                    <td style="font-style:italic">@if($product->publish == 'yes')<span class="text-muted">published</span> @else <span class="text-danger">not_published</span> @endif</td>
                    
                    @php
                        
                        $prod_img = $product->product_image;
                        $img = '';
                        $imgcount = count($prod_img);
                        if ($imgcount > 0){
                            $img = $prod_img[0]->image;
                        }
                    @endphp
                    <td class="search_param_4">
                        @foreach($prod_img as $img)
                        <img src="{{asset('product_images/'.$img->image)}}" alt="none" class="" style="max-height:100px">
                        <span hidden>{{$img->caption}}</span>
                        @endforeach
                    </td>

                    <td>
                        <a href="{{route('editProduct', $product->id)}}" class="btn btn-warning py-0">Edit </a> 
                        <span class="btn  py-0 btn-dark" onclick="deleteProduct('{{$product->botanical_name}}','{{$product->common_name}}', {{$product->id}})">Del</span>
                    </td>
                </tr>
            @endforeach
        </table>

        <hr>
        <div class="d-flex" id="bottom">
            <a class="btn btn-success" style="font-size:smaller" href="{{route('addProduct')}}">Add New</a>
            <a class="btn btn-dark m-auto" style="font-size:smaller" href="#top"><span class="">Back to Top</span></a>
        </div>

        </div> 
        
    </section>

    <form action="{{route('deleteProduct')}}" method="post" id="delete_product_form" hidden>
        @csrf
        <input type="text" name="delete_product_id" id="delete_product_id">
    </form>

    <script>
        function deleteProduct(bot_name, com_name, id){
            var proceed = confirm("CAUTION!! Are you sure you wish to delete: "+bot_name + "("+com_name+")" +" from the database?");
            if (proceed){
                var hidden_form = document.getElementById('delete_product_form');
                document.getElementById('delete_product_id').value = id;

                hidden_form.submit();
            }
        }
    </script>

<script src="{{asset('js/search.js')}}" defer></script>

@endsection