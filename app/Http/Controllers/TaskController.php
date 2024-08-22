<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Jobs\ProcessHighPriorityTask;
use App\Events\TaskUpdated;

class TaskController extends Controller
{
    /**
     * نمایش لیست وظایف.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tasks = Task::all();
        return view('task-list', compact('tasks'));
    }

    /**
     * نمایش فرم ایجاد وظیفه جدید.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('create-task');
    }

    /**
     * ذخیره وظیفه جدید در پایگاه داده.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:بالا,متوسط,پایین',
            'status' => 'required|in:در حال انجام,به تعویق افتاده,کامل شده',
        ]);

        $task = Task::create($validatedData);

        // بررسی اولویت وظیفه و ارسال به صف اگر اولویت بالا باشد
        if ($task->priority === 'بالا') {
            ProcessHighPriorityTask::dispatch($task)->onQueue('high_priority');
        }

        return redirect('/tasks'); // هدایت به صفحه‌ی لیست وظایف
    }

    /**
     * نمایش فرم ویرایش وظیفه خاص.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('edit-task', compact('task'));
    }

    /**
     * به‌روزرسانی وظیفه خاص.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:بالا,متوسط,پایین',
            'status' => 'required|in:در حال انجام,به تعویق افتاده,کامل شده',
        ]);

        $task = Task::findOrFail($id);
        $task->update($validatedData);

        // ارسال رویداد به WebSocket
        broadcast(new TaskUpdated($task));

        return redirect('/tasks'); // هدایت به صفحه‌ی لیست وظایف
    }

    /**
     * حذف وظیفه خاص.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect('/tasks'); // هدایت به صفحه‌ی لیست وظایف
    }
}


