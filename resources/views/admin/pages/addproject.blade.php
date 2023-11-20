@extends('admin.app')

@section('main-content')
    <section class="container">
        <h2 class="text-success">@if(isset($project))EDIT @else ADD @endif PROJECT</h2>
       
        <form action="{{route('saveProject')}}" method="POST" class="row bg-light p-2" enctype="multipart/form-data">
            <div class=" d-flex shadow-sm p-2">
                <a class="btn btn-light text-muted" style="font-size:smaller" href="{{route('projects')}}">[Back]</a>
            </div>
            @csrf
            @if (isset($project))
                <input type="text" name="edit_id" value="{{$project->id}}" hidden>
            @endif
            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">*Project Name</label>
                    <input type="text" id="title" name="title"  class="form-control" @if(isset($project)) value="{{$project->title}}" @endif>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">*Client</label>
                    <input type="text" id="client" name="client"  class="form-control" @if(isset($project)) value="{{$project->client}}" @endif>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">*PROJECT SCOPE</label>
                    <input type="text" id="scope" name="scope"  class="form-control" @if(isset($project)) value="{{$project->scope}}" @endif>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Notes</label>
                    <textarea name="notes" id="notes" rows="3" class="form-control">@if(isset($project)) {!!$project->notes!!} @endif</textarea>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title">Order</label>
                    <input type="number" id="order" name="order"  class="form-control" @if(isset($project)) value="{{$project->order}}" @endif>
                </div>
            </div>

            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label class="field_title">Publish <input type="checkbox" name="publish" value="yes" id="publish" @if(isset($project) && $project->publish == 'yes') checked="checked" @endif></label>
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
@endsection