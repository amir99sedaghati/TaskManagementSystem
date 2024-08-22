<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskCreator extends Component
{
    public $title, $description, $due_date, $priority, $status;

    public function createTask()
    {
        Task::create([
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'priority' => $this->priority,
            'status' => $this->status,
        ]);

        // پاک کردن ورودی‌ها پس از ایجاد وظیفه جدید
        $this->reset(['title', 'description', 'due_date', 'priority', 'status']);
    }

    public function render()
    {
        return view('livewire.task-creator');
    }
}
