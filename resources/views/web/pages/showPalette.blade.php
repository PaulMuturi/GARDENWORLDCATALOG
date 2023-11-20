@extends('web.app')

@section('main-content')
    <section class="">
        <div class="head_area text-dark p-3 text-center">
            <h1 class="text-warning">PLANTING PALETTE</h1>
            {{-- <hr class="text-muted container"> --}}
            <p class=""><span class="text-warning">Project: </span><span>{{$project->title}}</span></p>
            <p class=""><span class="text-warning">Client: </span><span>{{$project->client}}</span></p>
            @if ($project->scope)<p class=""><span class="text-warning">Scope: </span><span>{{$project->scope}}</span></p>@endif
            @if ($palette->notes)<p class=""><span class="text-warning">Description: </span><span>{{$palette->notes}}</span></p>@endif
            <p class=""><span class="text-warning">Landscape Consultant/Contractor: </span><span>Nairobi Botanica Gardening ltd</span></p>

        </div>

        <div class="sections_area">
            @foreach ($palette->sections as $section)
            <hr class="container text-success" style="">

                <div class="my-3">  
                    <div class="d-flex flex-wrap w-100 p-2 px-4 text-success container">
                        <h3 class="me-auto">{{$section->title}} </h3>
                        <p class="text-smaller m-auto">{{$section->notes}}</p>
                    </div>  
                    @php
                        $choices = explode(',', $section->image_ids);
                    @endphp

                    <div class="d-flex flex-wrap w-100" style="justify-content: center">
                        {{-- Loop through every product / plant --}}
                        @foreach ($products as $product)
                            {{-- Loop through images of a product --}}
                            @foreach ($product->product_image as $img)
                                {{-- Compare each of the choices with plants in database and display if a match --}}
                                @foreach ($choices as $choice)
                                    @php
                                        $choice = explode('_', $choice);
                                        $prod_id = $choice[0];
                                        $img_id = $choice[1];
                                    @endphp
                                    @if ($prod_id == $product->id && $img_id == $img->id)
                                        {{-- Show the image and its info --}}
                                        <div class="shadow m-auto  rounded mx-1 my-2 p-1 d-flex flex-column" style="max-width:250px;">
                                            <img src="{{asset('product_images/'.$img->image)}}" alt="" class="m-auto shadow" style="max-height: 200px; max-width:230px">
                                            <div class=" p-2 text-center">
                                                <span class="text-muted text-italic m-auto">{{$img->caption}}</span> <br>
                                                <span class="text-success">
                                                    @if($product->botanical_name){{$product->botanical_name}}@endif @if($product->common_name)({{$product->common_name}})@endif
                                                </span><br>
                                                @if(count($product->light_requirement))
                                                    <span class="text-warning text-smaller">Lighting:   
                                                        <span class="text-muted"> @foreach($product->light_requirement as $req)@if($loop->index > 0),@endif {{$req->requirement}}@endforeach</span>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection