@extends('admin.app')

@php
    $data = [
        [
            'title' => 'Products (Plants)',
            'route' => 'products'
        ],
        [
            'title' => 'Projects',
            'route' => 'projects'
        ],
        [
            'title' => 'Palettes',
            'route' => 'palettes'
        ],
        
    ];

    $data = json_decode(json_encode($data));
@endphp
@section('main-content')
    <div class="d-flex flex-column" style="height:100vh; ">
        
        <div class="row container m-auto  p-4"> 
            @foreach ($data as $item)
                <div class="col-lg-3 col-6 m-auto" >
                    <a href="{{route($item->route)}}" class="lead m-auto text-bold text-light" style="text-decoration: none">
                        <div class="p-2">
                            <div class="bg-success d-flex shadow link rounded" style="height: 200px">
                                <span class="m-auto">{{$item->title}}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection