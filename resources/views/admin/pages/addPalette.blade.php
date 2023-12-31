@extends('admin.app')

@section('main-content')
    <section class="container">
        <h2 class="text-success">@if(isset($palette))EDIT @else ADD @endif PALETTE</h2>
       
        <form action="{{route('savePalette')}}" id="mainForm" onsubmit="enableProjectId(event)" method="POST" style="" class="row bg-light p-2" enctype="multipart/form-data">
            <div class=" d-flex shadow-sm p-2">
                <a class="btn btn-light text-muted" style="font-size:smaller" href="{{route('palettes')}}">[Back]</a>
            </div>
            @csrf
            
            @if (isset($palette))
                <input type="text" name="edit_id" value="{{$palette->id}}" hidden>
            @endif
            <!-- Field -->
            <div class="col-md-6 field_item">
                <div class="">
                    <label for="" class="field_title" id="pick_project">*Project</label>
                    <select name="project_id" id="project_id" class="form-control m-auto" required>
                        <option value="">select project</option>
                        @foreach($projects as $project)
                            <option @if (isset($palette) && $palette->project_id == $project->id) selected id="enable" @endif @if (in_array($project->id, $projects_with_palette)) disabled @endif value="{{$project->id}}">{{$project->title}} @if($project->client)({{$project->client}})@endif</option>
                        @endforeach
                    </select>
                </div>
            </div>

             <!-- Field -->
             <div class="col-md-6 field_item m-auto">
                <div class="">
                    <label for="" class="field_title">Notes</label>
                    <textarea name="notes" id="notes" rows="3" class="form-control">@if(isset($palette)) {!!$palette->notes!!} @endif</textarea>
                </div>
            </div>

             <!-- Field -->
             <div class="col-md-6 field_item">
                <input type="submit" value="SAVE" class="btn btn-warning">
            </div>

            <hr class="mt-3">

            <div class="d-flex mt-3 bg-success px-3 py-1 rounded">
                <h1 class="text-light">SECTIONS </h1>

                @php         
                    $palette_id = null;           
                    if (isset($palette)){
                        $palette_id = $palette->id;
                    }
                @endphp
                <div class="m-auto">
                    <span class="btn btn-success m-auto border" onclick="addSection({{$palette_id}})">Add Section</span>
                </div>
            </div>

            @if (isset($palette))
                <div class="container mt-4">
                    <div class="row">
                        @foreach ($palette->sections as $item)
                            <div class="col-lg-4 bg-success col-sm-6 border rounded shadow">
                                <div class="bg-light p-3" style="min-height: 60px">                                
                                    <div class="d-flex">
                                        <h5 class="me-auto my-auto text-success">{{$item->title}}</h5>
                                        <a href="{{route('editSection', $item->id)}}" class="btn btn-warning ms-auto">Edit</a>
                                    </div>
                                    <hr>
                                    <p class="text-muted">{{$item->notes}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </form> 
    </section>
    <form action="{{route('deletePalette')}}" method="post" id="delete_palette_form" hidden>
        @csrf
        <input type="text" name="delete_palette_id" id="delete_palette_id">
    </form>

    <form action="{{route('addSection')}}" method="post" id="add_section_form" hidden>
        {{-- Caters for both add new and edit section --}}
        @csrf
        <input type="text" name="add_section_project_id" id="add_section_project_id">
        <input type="text" name="add_section_palette_notes" id="add_section_palette_notes">
        <input type="text" name="add_section_section_id" id="add_section_section_id">
        <input type="text" name="add_section_palette_id" id="add_section_palette_id">
    </form>

    <script>
        function addSection(palette_id){
            var project_id = document.getElementById('project_id').value;

            if (!project_id){
                alert("Please select a project");
            }

            var proceed = confirm("Current entries will be saved before being redirected to Add Section Page. Still proceed?");
            if (proceed){
                if (!palette_id){
                    palette_id = null;
                }

                document.getElementById('add_section_palette_id').value = palette_id;
                document.getElementById('add_section_project_id').value = project_id;
                document.getElementById('add_section_palette_notes').value = document.getElementById('notes').value;

                document.getElementById('add_section_form').submit();
            }
        }
    </script>

<script>
    function editSection(palette_id, section_id){
        var proceed = confirm("Current entries will be saved before being redirected to Add Section Page. Still proceed?");

        if (proceed){
            if (!palette_id){
                palette_id = null;
            }

            document.getElementById('add_section_palette_id').value = palette_id;
            document.getElementById('add_section_project_id').value = document.getElementById('project_id').value;
            document.getElementById('add_section_section_id').value = section_id;
            document.getElementById('add_section_project_notes').value = document.getElementById('notes').value;

            document.getElementById('add_section_form').submit();
        }
    }

    function enableProjectId(event){
        event.preventDefault();

        document.getElementById('enable').removeAttribute('disabled');
        document.getElementById('mainForm').submit();
        
    }
</script>
@endsection