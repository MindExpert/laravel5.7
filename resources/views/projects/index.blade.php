@extends('layout')

@section('content')
    <div class="box">
        <h1 class="title">Projects Folder</h1>
        <ul>
            @foreach ($projects as $project)
                <li>
                    <a href="/projects/{{ $project->id }}">
                        {{$project->title}}
                    </a>
                </li> 
            @endforeach
        </ul>
    </div>
    <div class="box"> 
        <a href="/projects/create" class="button is-link">Create new Project</a>
    </div>
@endsection