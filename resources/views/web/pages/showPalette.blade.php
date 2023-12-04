@extends('web.app')

@section('main-content')
    <section class="">
        <div class="head_area text-dark p-3 text-center">
            <h1 class="text-success text-bold">PLANTING PALETTE</h1>
            {{-- <hr class="text-muted container"> --}}
            @if ($project->title)<p class=""><span class="text-warning text-bold">Project: </span><span class="lead">{{$project->title}}</span></p>@endif
            @if ($project->client)<p class=""><span class="text-warning text-bold">Client: </span><span class="lead">{{$project->client}}</span></p>@endif
            @if ($project->scope)<p class=""><span class="text-warning text-bold">Scope: </span><span class="lead">{{$project->scope}}</span></p>@endif
            <p class=""><span class="text-warning text-bold">Landscape Consultant/Contractor: </span><span class="lead">Nairobi Botanica Gardening ltd</span></p>
            
            @if ($palette->notes)<p class="me-auto text-smaller"><span class="text-warning text-bold"></span><span class="" style="white-space: pre-wrap">{!!$palette->notes!!}</span></p>@endif
        </div>
        {{-- <hr> --}}
        <div class="sections_area">
            @foreach ($palette->sections as $section)
                {{-- <hr class="container text-success" style=""> --}}
                <div class="my-2">  
                    <div class="d-flex flex-wrap w-100 p-1 px-4 text-success shadow-sm" style="border-top: solid .1px grey">
                        <h3 class="m-auto text-center text-bold container">{{strtoupper($section->title)}} : </h3>
                        <p class="text-smaller m-auto container"> {!!$section->notes!!}</p>
                    </div>  
                    @php
                        $choices = explode(',', $section->image_ids);
                    @endphp

                    <div class="d-flex" >
                        
                        @foreach ($categorized_products as $cat_product)
                        <div class="m-auto py-1 d-flex flex-wrap w-100" style="justify-content:center">
                            {{-- check if categroy has any data --}}

                            @php
                                $iscat = false;
                                foreach ($cat_product->data as $product) {
                                    foreach ($product->product_image as $img){
                                        foreach ($choices as $choice){
                                            $choice = explode('_', $choice);
                                            $prod_id = $choice[0];
                                            $img_id = $choice[1];
                                            
                                            if ($prod_id == $product->id && $img_id == $img->id){
                                                $iscat = true;
                                            }
                                        }
                                    }
                                }
                            @endphp

                            @if ($iscat)
                                {{-- UNCOMMENT IF AUTO-CATEGORIZATION --}}
                                {{-- <div class="text-center shadow-sm d-flex px-3 my-auto" id="{{$cat_product->title}}" style="max-height:200px; max-width:250px" >
                                    <h5 class="me-auto text-success m-auto p-3" ><span class="text-underline">{{$cat_product->title}}</span>@if($cat_product->notes) <br><span class="text-smaller lead">{{$cat_product->notes}}</span>@endif </h5>
                                </div> --}}
                                    {{-- Loop through images of a product --}}
                                    @foreach ($cat_product->data as $product)                               
                                        @foreach ($product->product_image as $img)
                                            {{-- Compare each of the choices with plants in database and display if a match --}}
                                            @foreach ($choices as $choice)
                                                @php
                                                    $choice = explode('_', $choice);
                                                    $prod_id = $choice[0];
                                                    $img_id = $choice[1];
                                                @endphp
                                                @if ($prod_id == $product->id && $img_id == $img->id)
                                                    <span class="{{$cat_product->title}}" hidden></span>
                                                    {{-- Show the image and its info --}}
                                                    <div class="shadow-sm  m-auto  rounded mx-1 my-1 p-1 d-flex flex-column" style="max-width:250px;">
                                                        <img src="{{asset('product_images/'.$img->image)}}" alt="" class="mx-auto" style="max-height: 210px; max-width:240px">
                                                        <div class=" p-1 text-center">
                                                            @if ($img->caption)<span class="text-muted text-italic m-auto text-smaller" style="text-transform: capitalize">{{$img->caption}}</span> <br>@endif
                                                            <span class="text-success">
                                                                @if($product->botanical_name){{$product->botanical_name}}@endif @if($product->common_name)({{$product->common_name}})@endif
                                                            </span>
                                                            <br>
                                                            @if($product->category)
                                                                <span class="text-muted text-smaller text-italic "> -- {{$product->category}} --</span>
                                                            @endif
                    
                                                            {{-- UNCOMMENT FOR LIGHTING INFO --}}
                                                            {{-- @if(count($product->light_requirement))
                                                            <br>
                                                                <span class="text-warning text-smaller">Lighting:   
                                                                    <span class="text-muted"> @foreach($product->light_requirement as $req)@if($loop->index > 0),@endif {{$req->requirement}}@endforeach</span>
                                                                </span>
                                                            @endif --}}
                                                                                           
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection