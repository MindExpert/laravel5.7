<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


/*
    GET /projects --> (index)           - Show All projects (READ)
    GET /projects/create --> (create)   - Show me a form to create new project
    GET /projects/1 --> (show)          - Show me a single project
    ==================================================================
    POST /project --> (store)           - Store a new Projec (CREATE)
    GET /project/1/edit --> (edit)      - Show me a form to edit a Project
    ==================================================================
    PATCH /projects/1 --> (update)      - Update that project (UPDATE)
    ==================================================================
    DELETE /projects/1 --> (destroy)    - Deleting a Project (DELETE)

*/

Route::resource('projects', 'ProjectsController');
Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
// Route::patch('/tasks/{task}', 'ProjectTasksController@update');

// Different approach for tasks controller
Route::post('/completed-tasks/{task}', 'CompletedTasksController@store');
Route::delete('/completed-tasks/{task}', 'CompletedTasksController@destroy');




// Route::get('/projects', 'ProjectsController@index');
// Route::post('/projects', 'ProjectsController@store');
// Route::get('/projects/create', 'ProjectsController@create');
// Route::get('/projects/{project}', 'ProjectsController@show');
// Route::patch('/projects/{project}', 'ProjectsController@update');
// Route::delete('/projects/{project}', 'ProjectsController@destroy');
// Route::get('/projects/{project}/edit', 'ProjectsController@edit');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
