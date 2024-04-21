@extends('web.app')

@section('main-content')
    <section class="">
        <div class="head_area text-dark p-3 text-center">
            <h1 class="text-success text-bold">PLANTING PALETTE</h1>
            {{-- <hr class="text-muted container"> --}}
            @if ($project->title)<p class=""><span class="text-warning text-bold">Project: </span><span class="lead" style="text-transform: uppercase">{{$project->title}}</span></p>@endif
            @if ($project->client)<p class=""><span class="text-warning text-bold">Client: </span><span class="lead" style="text-transform: uppercase">{{$project->client}}</span></p>@endif
            @if ($project->scope)<p class=""><span class="text-warning text-bold">Scope: </span><span class="lead" style="text-transform: uppercase">{{$project->scope}}</span></p>@endif
            {{-- <p class=""><span class="text-warning text-bold">Landscape Consultant/Contractor: </span><span class="lead" style="text-transform: uppercase">NIFTYPALM DESIGNS</span></p> --}}
            <p class=""><span class="text-warning text-bold">Landscape Consultant/Contractor: </span><span class="lead" style="text-transform: uppercase">NAIROBI BOTANICA GARDENING LTD</span></p>

            @if ($palette->notes)<p class="me-auto text-smaller"><span class="text-warning text-bold"></span><span class="" style="white-space: pre-wrap">{!!$palette->notes!!}</span></p>@endif
        </div>
        {{-- <hr> --}}

        <div class="sections_area">
            @foreach ($sections as $section)
                {{-- <hr class="container text-success" style=""> --}}
                <div class="my-2">  
                    <div class="d-flex flex-wrap w-100 p-1 px-4 text-success shadow-sm" style="border-top: solid .1px grey">
                        <h3 class="m-auto text-center text-bold container">{{strtoupper($section->title)}} : </h3>
                        <p class="text-smaller m-auto container text-center"> {!!$section->notes!!}</p>
                    </div>  


                    <div class="d-flex" >
                        @foreach ($cat_order as $cat)                            
                            <div class="m-auto py-1 d-flex flex-wrap w-100" style="justify-content:center">
                            {{-- check if categroy has any data --}}
                                @php
                                    $iscat = false;
                                    foreach ($all_products as $product) {
                                        foreach ($product->product_image as $img){
                                            foreach ($section->palette_sections as $choice){
                                                $prod_id = $choice->product_id;                                                    
                                                $img_id = $choice->img_id;                                                    
                                                
                                                if ($prod_id == $product->id && $img_id == $img->id && $cat == $choice->override_category){
                                                    $iscat = true;                                                    
                                                }


                                            }
                                        }
                                    }
                                @endphp
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>


        {{-- OLD STARTS HERE --}}
        
    </section>
@endsection