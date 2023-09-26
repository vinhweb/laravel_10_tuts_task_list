<?php
	
	use App\Http\Requests\TaskRequest;
	use App\Models\Task;
	use Illuminate\Http\Request;
	use Illuminate\Http\Response;
	use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


	Route::get('/', function () {
		$tasks = Task::latest()->paginate(10);
		
	    return view('index', [
			'tasks' => $tasks
	    ]);
	})->name('tasks');
	
	Route::get('/tasks', function () {
		$tasks = Task::latest()->paginate(10);
		
		return view('index', [
			'tasks' => $tasks
		]);
	})->name('tasks.index');
	
	Route::get('/tasks/{task}/edit', function (Task $task) {
		return view('edit', ['task' => $task]);
	})->name('tasks.edit');
	Route::put('/tasks/{task}', function(TaskRequest $request, Task $task){
		$task->update($request->validated());
		
		return redirect()->route('tasks.single', ['task' => $task->id])
			->with('success', 'Đã sửa thành công task!');
	})->name('tasks.update');
	
	Route::view('/tasks/create', 'create')->name('tasks.create');
	Route::post('/tasks', function(TaskRequest $request){
		$task = Task::create($request->validated());
		
		return redirect()->route('tasks.single', ['task' => $task->id])
			->with('success', 'Đã tạo thành công task!');
	})->name('tasks.store');
	
	Route::delete('/tasks/{task}', function(Task $task){
		$task->delete();
		
		return redirect()->route('tasks')
			->with('success', 'Đã xóa thành công task!');
	})->name('tasks.destroy');
	
	Route::put('tasks/{task}/toggle-complete', function(Task $task){
		$task->toggleComplete();
		
		return redirect()->back()
			->with('success', 'Cập nhật task thành công!');
	})->name('tasks.toggle-complete');
	
	
	Route::get('/tasks/{task}', function (Task $task) {
		return view('single', ['task' => $task]);
	})->name('tasks.single');