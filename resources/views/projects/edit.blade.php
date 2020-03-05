@extends('layout')

@section('content')
    <h1 class="title">Edit Page</h1>

    <form method="POST" action="/projects/{{ $project->id}}" style="margin-bottom: 1em">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <div class="field">
            <label class="label" for="title">Title</label>
            <div class="control">
            <input type="text" class="input" name="title" placeholder="Title" value="{{ $project->title}}" required>
            </div>     
        </div>
        <div class="field">
            <label class="label" for="textarea">Description</label>
            <div class="control">
                <textarea type="text" class="input" name="description" rows="10" placeholder="Description" required>{{ $project->description}}</textarea>
            </div> 
        </div>
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Update Project</button> 
            </div>
        </div>
    </form>

    <form method="POST" action="/projects/{{ $project->id}}">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <div class="field">
            <div class="control">
                <button type="submit" class="button">Delete Project</button> 
            </div>
        </div>
    </form>

@endsection