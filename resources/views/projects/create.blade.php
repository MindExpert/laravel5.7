@extends('layout')

@section('content')
    <h1 class="title">Create Project</h1>
        <form action="/projects" method="POST">
            {{ csrf_field() }}
            <div class="field">
                <label class="label" for="title">Title</label>
                <div class="control">
                <input type="text" class="input {{ $errors->has('title') ? 'is-danger' : ''}}" name="title" placeholder="Project Titlle" value="{{ old('title')}}">
                </div>     
            </div>
            <div class="field">
                <label class="label" for="textarea">Description</label>
                <div class="control">
                    <textarea type="text" class="input {{ $errors->has('description') ? 'is-danger' : ''}}" name="description" placeholder="Description" >{{ old('description')}}</textarea>
                </div> 
            </div>
            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-link"> Submit Form </button>
                </div>
            </div>
            @include('errors')
        </form>
@endsection
