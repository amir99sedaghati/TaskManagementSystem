<table>
    <thead>
        <tr>
            <th>عنوان</th>
            <th>توضیحات</th>
            <th>تاریخ پایان</th>
            <th>اولویت</th>
            <th>وضعیت</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
        <tr>
            <td>{{ $task->title }}</td>
            <td>{{ $task->description }}</td>
            <td>{{ $task->due_date }}</td>
            <td>{{ $task->priority }}</td>
            <td>{{ $task->status }}</td>
            <td>
                <a href="{{ url('/tasks/' . $task->id . '/edit') }}" class="edit-link">ویرایش</a>
                <button wire:click="deleteTask({{ $task->id }})" class="delete-link" onclick="return confirm('آیا مطمئن هستید؟')">حذف</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<script>
    window.Echo.channel('tasks')
        .listen('TaskUpdated', (event) => {
            // بروزرسانی لیست وظایف یا انجام اقدامات دیگر
            console.log('Task updated:', event.task);
            // بروزرسانی لیست وظایف با داده‌های جدید
        });
</script>
