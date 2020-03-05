@extends('layout')

@section('content')
    <h1 class="title">{{ $project->title}}</h1>
    <div class="content">
        {{ $project->description}}
        <p><a href="/projects/{{ $project->id }}/edit">Edit</a></p>
    </div>
    

    @if ($project->tasks->count() )
        <div class="box">

            @foreach ($project->tasks as $task)
                <div>

                    <form method="POST" action="/completed-tasks/{{ $task->id }}">
                        @if ($task->completed)
                            @method('DELETE')  
                        @endif
                        @csrf
                        <label for="completed" class="checkbox {{ $task->completed ? 'is-complete' : ''}}">
                            <input name="completed" type="checkbox" onchange="this.form.submit()" {{ $task->completed ? 'checked' : ''}}>
                            {{ $task->description}}
                        </label>
                    </form>

                </div>
            @endforeach

        </div>
    @endif

    {{-- add a new Task --}}

    <form method="POST" action="/projects/{{ $project->id}}/tasks" class="box">
        {{ csrf_field() }}
        <div class="field">
            <label class="label" for="description">New task</label>
            <div class="control">
                <input type="text" class="input" name="description" placeholder="New task">
            </div>     
        </div>
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Add Task</button> 
            </div>
        </div>
        @include('errors')
    </form>

@endsection