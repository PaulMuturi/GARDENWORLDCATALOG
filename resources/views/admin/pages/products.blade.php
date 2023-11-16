@extends('admin.app')

@section('main-content')
    <section class="container">
        <h2 class="text-success">PRODUCTS</h2>
        <div class="row">
            <div class="col-4">

                <a class="btn btn-success" style="font-size:smaller" href="{{route('addProduct')}}">Add New</a>
            </div>
            <div class="col-8">
                <label for="">Search: <input type="text" id="searchInput" class="border rounded"></label>
            </div>
        </div>
        <div class="bg-light p-2">
            @csrf
            <table class="table table-striped">
            <th>
                <!-- <td>NO</td> -->
                <td>NAME</td>
                <td>CATEGORY</td>
                <td>PROPERTIES</td>
                <td>STATUS</td>
                <td>IMAGE(S)</td>
                <td>ACTION</td>
            </th>            
            @foreach($products as $product)
                <tr class="text-muted tr" style="font-size:">
                    <td>{{$loop->index + 1}}</td>
                    <td class="search_param_1 text-dark"  style="font-size:normal">@if($product->botanical_name){{$product->botanical_name}}@endif @if($product->common_name)({{$product->common_name}})@endif</td>
                    <td class="search_param_2">
                        @php $cat = str_replace('_', ' ', $product->category)@endphp
                        {{$cat}} <span hidden>{{$product->category}}</span>
                    </td>
                    <td class="search_param_3">
                        @if($product->light_requirement) 
                            @foreach($product->light_requirement as $req)
                            @php $light = str_replace('_', ' ', $req->requirement)@endphp
                                {{$req->requirement}}, 
                                {{-- The following is for the sake of searching, it's hidden --}}
                                <span hidden>{{$light}}</span>
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
                        <img src="{{asset('products/'.$img->image)}}" alt="none" class="" style="max-height:100px">
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
        <a class="btn btn-success" style="font-size:smaller" href="{{route('addProduct')}}">Add New</a>

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