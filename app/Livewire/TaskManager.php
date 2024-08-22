<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskManager extends Component
{
    public $tasks;

    public function mount()
    {
        $this->tasks = Task::all();
    }

    public function deleteTask($taskId)
    {
        Task::find($taskId)->delete();
        $this->tasks = Task::all(); // به‌روزرسانی لیست وظایف
    }

    public function render()
    {
        return view('livewire.task-manager');
    }
}

