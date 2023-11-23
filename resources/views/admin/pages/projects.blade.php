@extends('admin.app')

@section('main-content')
    <section class="container-fluid">
        <div class=" d-flex shadow-sm p-2">
            <a class="btn btn-light text-muted" style="font-size:smaller" href="{{route('dashboard')}}">[Back]</a>
        </div>
        <h2 class="text-success">PROJECTS</h2>
        <div class="row">
            <div class="col-6">
                <div class="d-flex">
                    <a class="btn btn-success" style="font-size:smaller" href="{{route('addProject')}}">Add New</a>
                    <a class="btn btn-dark ms-auto" style="font-size:smaller" href="#bottom"><span class="">Go to Bottom</span></a>
                </div>
            </div>
            <div class="col-6 d-flex">
                <label for="" class="ms-auto">Search: <input type="text" id="searchInput" class="border rounded"></label>
            </div>
        </div>
        
        <div class="bg-light p-2">
            @csrf
            <table class="table table-striped shadow-sm p-2 my-3"  id="#top">
                @if (isset($message))
                    <div class="alert alert-warning">{{$message}}</div>
                @endif
                <hr>
            <th >
                <!-- <td>NO</td> -->
                <td class="text-bold">NAME</td>
                <td class="text-bold">CLIENT</td>
                <td class="text-bold">SCOPE</td>
                <td class="text-bold">PUBLISH</td>
                <td class="text-bold">ACTION</td>
            </th>            
            @foreach($projects as $project)
                <tr class="text-muted tr" style="font-size:">
                    <td>{{$loop->index + 1}}</td>
                    <td class="search_param_1 text-dark"  style="font-size:normal">{{$project->title}}</td>
                    <td class="search_param_2">{{$project->client}}
                        @if (isset($project->palette->id))
                            <a target="_blank" href="{{route('showPalette',$project->palette->id )}}" class="btn btn-warning text-italic text-small">Show palette</a>
                        @endif
                    </td>
                    <td class="search_param_3">{{$project->scope}}</td>
                    <td style="font-style:italic">@if($project->publish == 'yes')<span class="text-muted">published</span> @else <span class="text-danger">not_published</span> @endif</td>
                    <td>
                        <a href="{{route('editProject', $project->id)}}" class="btn btn-warning py-0">Edit </a> 
                        <span class="btn  py-0 btn-dark" onclick="deleteProject('{{$project->title}}', {{$project->id}})">Del</span>
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

    <form action="{{route('deleteProject')}}" method="post" id="delete_project_form" hidden>
        @csrf
        <input type="text" name="delete_project_id" id="delete_project_id">
    </form>

    <script>
        function deleteProject(title, id){
            var proceed = confirm(`CAUTION!! Are you sure you wish to delete: ${title} project from the database?`);
            if (proceed){
                var hidden_form = document.getElementById('delete_project_form');
                document.getElementById('delete_project_id').value = id;

                hidden_form.submit();
            }
        }
    </script>

<script src="{{asset('js/search.js')}}" defer></script>

@endsection