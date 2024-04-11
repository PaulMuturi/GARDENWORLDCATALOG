@extends('admin.app')

@section('main-content')
    <section class="container">
        <h2 class="text-success">@if(isset($sectionData))EDIT @else ADD @endif SECTION</h2>
       
        <form action="{{route('saveSection')}}" id="page_top" method="POST" class=" p-2" enctype="multipart/form-data">
            <div class=" d-flex shadow-sm p-2">
                <a class="btn btn-light text-muted" style="font-size:smaller" href="{{route('editPalette', $palette->id)}}">[Back]</a>
            </div>
            @csrf
            @if (isset($sectionData))
                <input type="text" name="edit_id" value="{{$sectionData->id}}" hidden>
            @endif

            {{-- Palette details displayed --}}
            <div class="p-3 mt-3 lead text-center">
                <span class="text-success text-bold">{{$project->title}}</span></p>
                <p><span class="text-muted">For: </span><span>{{$project->client}}</span></p>
                <p><span>{{$palette->notes}}</span></p>
                <input hidden type="number" id="palette_id" name="palette_id" value="{{$palette->id}}"f>
            </div>

            <div class="row py-4 border mt-3 rounded bg-light">
                {{-- Section inputs start here --}}
                <!-- Field -->
                <div class="col-md-6 field_item m-auto">
                    <div class="">
                        <label for="" class="field_title">*Section Title</label>
                        <input required type="text" id="title" name="title"  class="form-control" @if(isset($sectionData)) value="{{$sectionData->title}}" @endif>
                    </div>
                </div>
    
                <!-- Field -->
                <div class="col-md-6 field_item m-auto">
                    <div class="">
                        <label for="" class="field_title">Section Notes</label>
                        <textarea name="notes" id="notes" rows="3" class="form-control">@if(isset($sectionData)) {!!$sectionData->notes!!} @endif</textarea>
                    </div>
                </div>

                <div>
                    <a href="#selection_panel" class="btn border my-2">Make Selection</a>
                    <h4 class="text-success">Current choices</h4>
                    <ol id="current_choices" class="text-muted"></ol>
                </div>
            </div>


            {{-- Selection of products below --}}
            <div class="mt-5 p-4 border" id="selection_panel">
                <a href="#page_top" class="btn border my-2">View current selection</a>
                {{-- Search area head --}}
                <div class="row shadow-sm rounded bg-success">
                    <div class="col-6 m-auto">
                        <div class="d-flex">
                            <h4 class="text-light">Select Below</a>
                        </div>
                    </div>
                    <div class="col-6 d-flex">
                        <label for="" class="m-auto p-2"><span class="text-light">Search: </span><input type="text" id="searchInput" class="border rounded"></label>
                    </div>
                </div>

                <div class=""  style="height:50vh; overflow:scroll">
                    <table class="table table-striped shadow-sm p-2 my-3">
                        @php 
                            $choices = [];
                            $item_count = 0;
                            if (isset($sectionData)){
                                $choices = explode(',', $sectionData->image_ids);
                            }
                        @endphp
                        @foreach($products as $product)
                            @foreach ($product->product_image as $img)  
                                @php $item_count++;@endphp   
                                <tr class="text-muted tr" style="font-size:">
                                    {{-- <td>{{$item_count}}</td> --}}

                                    <td class="search_param_1 text-dark"  style="font-size:normal">
                                        @php
                                            $checked = '';
                                            foreach ($choices as $choice) {
                                                $choice = explode('_', $choice);
                                                $choice_count = count($choice);
                                                $qty = 0;
                                                $rate = 0;

                                                if ($choice_count  < 2){
                                                    break;
                                                }
                                                $prod_id = $choice[0];
                                                $img_id = $choice[1];
                                                if ($choice_count == 4){
                                                    $qty = $choice[2];
                                                    $rate = $choice[3];
                                                }

                                                if ($product->id == $prod_id && $img->id == $img_id){
                                                    $checked = 'checked';
                                                    break;
                                                }
                                            }
                                        @endphp
                                        @if ($checked)
                                        {{-- Dynamically add list element to current choices --}}
                                            <script>
                                                var ul = document.getElementById('current_choices');
                                                var li = document.createElement('li');
                                                var bname =@json($product->botanical_name);
                                                var cname =@json($product->common_name);
                                                var capt = @json($img->caption);
                                                // var j_qty = @json($qty);
                                                // var j_rate = @json($rate);
                                                var capt_sep = '-';
                                                var first_brkt = '(';
                                                var second_brkt = ')'
                                                if (bname == null){bname = ""};
                                                if (cname == null){cname = ""; first_brkt = ''; second_brkt = ''};
                                                if (capt == null){capt = ""; capt_sep = ''};
                                                var val = `${bname} ${first_brkt}${cname}${second_brkt} ${capt_sep} ${capt}`;
                                                // var val = `${bname} ${first_brkt}${cname}${second_brkt} ${capt_sep} ${capt}  [ qty: ${j_qty} @ ${j_rate} => Ksh: ${j_qty * j_rate} ]`;
                                                li.appendChild(document.createTextNode(val));
                                                ul.appendChild(li);
                                            </script>
                                        @endif
                                        <label>
                                            {{-- Format value: product_id, image_id separated by underscore(_) --}}
                                            <input type="checkbox" {{$checked}} value="{{$product->id}}_{{$img->id}}" class="mx-2" name="choice[]" style="transform: scale(2)">
                                            <span class=""> @if($product->botanical_name){{$product->botanical_name}}@endif @if($product->common_name)({{$product->common_name}})@endif</span>
                                        </label>
                                    </td>
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
    
                                        @if(strlen($product->maintenance) > 0) 
                                            <span> {{$product->maintenance}} maintenance,</span>
                                        @endif
    
                                        @if(strlen($product->water_requirements) > 0) 
                                            <span> {{$product->water_requirements}} watering</span>
                                        @endif

                                        {{-- The following is for the sake of searching based on garden type, it's hidden --}}
                                        @if($product->gardentype) 
                                        @foreach($product->gardentype as $gtype)
                                        @php $type = str_replace('_', ' ', $gtype->gardentype)@endphp
                                        <div class="" hidden>
                                            {{$gtype->gardentype}}, 
                                            
                                            <span >{{$type}}</span>
                                        </div>
                                        @endforeach
                                    @endif
                                    </td>
                                    {{-- <td class="">
                                        <div class="d-flex">
                                            Qty. <input class="rounded border text-center" value="{{$qty}}" type="number" disabled>
                                        </div>
                                        <div class="d-flex">
                                            Rate <input class="rounded border text-center" value="{{$rate}}" type="number" disabled>
                                        </div>
                                    </td> --}}
                                    {{-- <td style="font-style:italic">@if($product->publish == 'yes')<span class="text-muted">published</span> @else <span class="text-danger">not_published</span> @endif</td> --}}                                
                                    <td class="search_param_4">
                                        <img src="{{asset('product_images/'.$img->image)}}" alt="none" class="" style="max-height:100px">
                                        <br><span class="text-muted text-smaller text-italic">{{$img->caption}}</span>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="col-md-6 field_item">
                <input type="submit" value="SAVE" class="btn btn-warning">
            </div>

        </form> 
    </section>

    <form action="{{route('deleteImg')}}" id="delete_img_form" method="POST" hidden>
        @csrf
        <input type="number" name="img_id"  id="delete_img_id">
        <input type="number" name="product_id"  id="delete_img_product_id">
    </form>

    <form action="{{route('editCaption')}}" id="edit_caption_form" method="POST" hidden>
        @csrf
        <input type="text" name="caption" id="edit_caption_new">
        <input type="number" name="img_id" id="edit_caption_id">
        <input type="number" name="product_id" id="edit_caption_product_id">
    </form>

    <script>
        function removeImage(img_name, img_id, img_product_id){
            var proceed = confirm("Are you sure you wish to remove the image?");

            if (proceed){
                // document.getElementById(imgname).remove();
                document.getElementById('delete_img_id').value = img_id;
                document.getElementById('delete_img_product_id').value = img_product_id;

                document.getElementById('delete_img_form').submit();
            }
        }

        function editCaption(img_name, img_id, img_product_id, current_caption){

            var cur = `Current caption: ${current_caption} `;
            if (!current_caption){
                cur = "";
            }
            
            var new_caption = prompt(`${cur}  (Set new caption for ${img_name})`);

            if (new_caption)
            {
                document.getElementById('edit_caption_new').value = new_caption;
                document.getElementById('edit_caption_id').value = img_id;
                document.getElementById('edit_caption_product_id').value = img_product_id;

                document.getElementById('edit_caption_form').submit();
            }
        }
    </script>

    <script src="{{asset('js/search.js')}}" defer></script>

@endsection