@extends('admin.app')

@section('main-content')
    <section class="container">
        <h2 class="text-success">@if(isset($product))EDIT @else ADD @endif PRODUCT</h2>
       
        <form action="{{route('saveProduct')}}" method="POST" class="row bg-light p-2" enctype="multipart/form-data">
            <div class=" d-flex shadow-sm p-2">
                <a class="btn btn-light text-muted" style="font-size:smaller" href="{{route('products')}}">[Back]</a>
            </div>
            @csrf
            @if (isset($product))
                <input type="text" name="edit_id" value="{{$product->id}}" hidden>
            @endif
            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">*Botanical name</label>
                    <input type="text" id="botanical_name" name="botanical_name"  class="form-control" @if(isset($product)) value="{{$product->botanical_name}}" @endif>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">*Common name</label>
                    <input type="text" id="common_name"  name="common_name" class="form-control" @if(isset($product)) value="{{$product->common_name}}" @endif>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">*Category</label>
                    <select name="category" id="category" class="form-control">
                        <option value="">None selected</option>
                        @foreach($product_fp->category as $cat)
                            <option value="{{$cat->db_name}}" @if(isset($product) && $product->category == $cat->db_name) selected='selected' @endif>{{$cat->display_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item border rounded p-2" title="Upload new image">
                <div class="p-2">
                    <label for="" class="field_title">*Image</label>
                    @if(isset($product))
                        <div class="row mb-2">
                            @foreach($product->product_image as $img)
                            <div class="col-sm-6 col-lg-4 col-8 d-flex flex-column shadow-sm border p-2" id="{{$img}}">
                                <div class="d-flex">
                                    <span class="btn btn-dark py-0 me-auto" style="font-size:smaller" onclick="editCaption('{{$img->image}}', '{{$img->id}}', '{{$img->product_id}}', '{{$img->caption}}')">Edit caption</span>
                                    <span class="btn btn-dark py-0 ms-auto" style="font-size:smaller" onclick="removeImage('{{$img->image}}', '{{$img->id}}', '{{$img->product_id}}')">x</span>
                                </div>
                                <img src="{{asset('product_images/'.$img->image)}}" alt="" class="col-12">
                                <span class="text-muted"><i>{{$img->caption}}</i></span>
                                <input hidden type="text" name="existing_image[]" value="{{$img}}" >
                            </div>
                            @endforeach
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control">
                    <div class="p-3"> <label class="field_title">*Caption </label> <input type="text" name="caption" class="rounded col-8" style="border:solid 0.5px #D3D3D3; "></div>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">*Selling price (Ksh)</label>
                    <input type="number" name="selling_price" id="selling_price" class="form-control" @if(isset($product)) value="{{$product->selling_price}}" @endif>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">*Max discounted price (Ksh)</label>
                    <input type="number" name="max_discounted_price" id="max_discounted_price" class="form-control" @if(isset($product)) value="{{$product->max_discounted_price}}" @endif>
                </div>
            </div>

             <!-- Field -->
             <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">*BOQ price (Ksh)</label>
                    <input type="number" name="boq_price" id="boq_price" class="form-control" @if(isset($product)) value="{{$product->boq_price}}" @endif>
                </div>
            </div>
            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Stocked quantity</label>
                    <div class="d-flex">
                        <input type="number" min="0" name="stocked_qty" class="no_border_rounded" @if(isset($product)) value="{{$product->stocked_qty}}" @endif>
                        <select name="stocked_qty_units" id="stocked_qty_units" class="">
                            <option value="no" @if(isset($product) && $product->stocked_qty_units == "no") selected='selected' @endif>No.</option>
                            <option value="bags" @if(isset($product) && $product->stocked_qty_units == "bags") selected='selected' @endif>Bags</option>
                            <option value="sqm" @if(isset($product) && $product->stocked_qty_units == "sqm") selected='selected' @endif>SQM</option>
                            <option value="ton" @if(isset($product) && $product->stocked_qty_units == "ton") selected='selected' @endif>Ton</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Notes</label>
                    <textarea name="notes" id="notes" rows="3" class="form-control">@if(isset($product)) {!!$product->notes!!} @endif</textarea>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label class="field_title">Publish <input type="checkbox" name="publish" value="yes" id="publish" @if(isset($product) && $product->publish == 'yes') checked="checked" @endif></label>
                </div>
            </div>

            <div class="col-md-6 field_item">
                <input type="submit" value="SAVE" class="btn btn-warning">
            </div>

            <!-- Field -->
            <div class="col-md-12 field_item">
                <div class="">
                    <label for="" class="field_title">General Color (if not a plant)</label>
                    <div class="d-flex">
                        @foreach($product_fp->colors as $color)

                            @php
                                $checked = "";
                            @endphp

                            @if(isset($product))
                            
                                @php
                                    foreach($product->general_color as $db_color){
                                        if ($db_color->color == $color->db_name){
                                            $checked = "checked";  
                                        }
                                    }
                                @endphp
                            @endif

                           
                            <label class="border p-2 text-dark"><span>{{$color->display_name}}</span> 
                                <input type="checkbox" value="{{$color->db_name}}" name="general_color[]" class="no_border_rounded" @if ($checked == "checked") checked @endif >
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <hr class="mt-3 text-success">
            <h4 class="text-success">WHERE APPLICABLE</h4>
            <!-- Field -->
            <!-- <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Foliage color</label>
                    <select name="foliage_color" id="foliage_color" class="form-control">
                        <option value="">None selected</option>
                        @foreach($product_fp->colors as $color)
                            <option value="{{$color->db_name}}" @if(isset($product) && $product->foliage_color == $color->db_name) selected='selected' @endif>{{$color->display_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div> -->

            <!-- Field -->
            <div class="col-md-12 field_item">
                <div class="">
                    <label for="" class="field_title">Foliage color</label>
                    <div class="d-flex">
                        @foreach($product_fp->colors as $color)

                            @php
                                $checked = "";
                            @endphp

                            @if(isset($product))
                            
                                @php
                                    foreach($product->foliage_color as $db_color){
                                        if ($db_color->color == $color->db_name){
                                            $checked = "checked";  
                                        }
                                    }
                                @endphp
                            @endif

                           
                            <label class="border p-2 text-dark"><span>{{$color->display_name}}</span> 
                                <input type="checkbox" value="{{$color->db_name}}" name="foliage_color[]" class="no_border_rounded" @if ($checked == "checked") checked @endif >
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-12 field_item">
                <div class="">
                    <label for="" class="field_title">Flower color</label>
                    <div class="d-flex">
                        @foreach($product_fp->colors as $color)

                            @php
                                $checked = "";
                            @endphp

                            @if(isset($product))
                            
                                @php
                                    foreach($product->flower_color as $db_color){
                                        if ($db_color->color == $color->db_name){
                                            $checked = "checked";  
                                        }
                                    }
                                @endphp
                            @endif

                           
                            <label class="border p-2 text-dark"><span>{{$color->display_name}}</span> 
                                <input type="checkbox" value="{{$color->db_name}}" name="flower_color[]" class="no_border_rounded" @if ($checked == "checked") checked @endif >
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Field -->
            <!-- <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Flower color</label>
                    <select name="flower_color" id="flower_color" class="form-control">
                        <option value="">None selected</option>
                        @foreach($product_fp->colors as $color)
                            <option value="{{$color->db_name}}" @if(isset($product) && $product->flower_color == $color->db_name) selected='selected' @endif>{{$color->display_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div> -->

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Maintenance</label>
                    <select name="maintenance" id="maintenance" class="form-control">
                        <option value="">None selected</option>
                        @foreach($product_fp->maintenance as $maintenance)
                            <option value="{{$maintenance->db_name}}" @if(isset($product) && $product->maintenance == $maintenance->db_name) selected='selected' @endif>{{$maintenance->display_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

             <!-- Field -->
             <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Planting interval</label>
                    <div class="d-flex">
                            <input type="number" name="planting_interval" class="no_border_rounded" @if(isset($product)) value="{{$product->planting_interval}}" @endif>
                            <select name="planting_interval_units" id="planting_interval_units" class="">
                                <option value="mm" @if(isset($product) && $product->planting_interval_units == "mm") selected='selected' @endif>mm</option>
                                <option value="cm" @if(isset($product) && $product->planting_interval_units == "cm") selected='selected' @endif>cm</option>
                                <option value="ft" @if(isset($product) && $product->planting_interval_units == "ft") selected='selected' @endif>ft</option>
                            </select>
                    </div>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Mature spread</label>
                    <div class="d-flex">
                        <input type="number" name="mature_spread" class="no_border_rounded" @if(isset($product)) value="{{$product->mature_spread}}" @endif>
                        <select name="mature_spread_units" id="mature_spread_units" class="">
                            <option value="mm" @if(isset($product) && $product->mature_spread_units == "mm") selected='selected' @endif>mm</option>
                            <option value="cm" @if(isset($product) && $product->mature_spread_units == "cm") selected='selected' @endif>cm</option>
                            <option value="ft" @if(isset($product) && $product->mature_spread_units == "ft") selected='selected' @endif>ft</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Mature height</label>
                    <div class="d-flex">
                        <input type="number" name="mature_height" class="no_border_rounded" @if(isset($product)) value="{{$product->mature_height}}" @endif>
                        <select name="mature_height_units" id="mature_height_units" class="">
                            <option value="mm" @if(isset($product) && $product->mature_height_units == "mm") selected='selected' @endif>mm</option>
                            <option value="cm" @if(isset($product) && $product->mature_height_units == "cm") selected='selected' @endif>cm</option>
                            <option value="ft" @if(isset($product) && $product->mature_height_units == "ft") selected='selected' @endif>ft</option>
                        </select>
                    </div>
                </div>
            </div>

             <!-- Field -->
             <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Light requirements</label>
                    <div class="d-flex">
                        @foreach($product_fp->light_requirements as $req)

                            @php
                                $checked = "";
                            @endphp

                            @if(isset($product))
                            
                                @php
                                    foreach($product->light_requirement as $db_req){
                                        if ($db_req->requirement == $req->db_name){
                                            $checked = "checked";  
                                        }
                                    }
                                @endphp
                            @endif

                           
                            <label class="border p-2"><span>{{$req->display_name}}</span> 
                                <input type="checkbox" value="{{$req->db_name}}" name="light_requirements[]" class="no_border_rounded" @if ($checked == "checked") checked @endif >
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Water requirements</label>
                    <select name="water_requirements" id="water_requirements" class="form-control">
                        <option value="">None selected</option>
                        @foreach($product_fp->water_requirements as $req)
                            <option value="{{$req->db_name}}" @if(isset($product) && $product->water_requirements == $req->db_name) selected='selected' @endif>{{$req->display_name}}</option>
                        @endforeach
                    </select>      
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Toxicity to humans</label>
                    <select name="toxicity_to_humans" id="toxicity_to_humans" class="form-control">
                        @foreach($product_fp->toxicity as $level)
                            <option value="{{$level->db_name}}" @if(isset($product) && $product->toxicity_to_humans == $level->db_name) selected='selected' @endif>{{$level->display_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Toxicity to pets</label>
                    <select name="toxicity_to_pets" id="toxicity_to_pets" class="form-control">
                        @foreach($product_fp->toxicity as $level)
                            <option value="{{$level->db_name}}" @if(isset($product) && $product->toxicity_to_pets == $level->db_name) selected='selected' @endif>{{$level->display_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Field -->
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
@endsection
