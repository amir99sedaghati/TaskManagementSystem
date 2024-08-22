<form wire:submit.prevent="createTask">
    <div class="mb-3">
        <label for="title" class="form-label">عنوان وظیفه</label>
        <input type="text" class="form-control" id="title" wire:model="title" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">توضیحات</label>
        <textarea class="form-control" id="description" wire:model="description"></textarea>
    </div>
    <div class="mb-3">
        <label for="due_date" class="form-label">تاریخ پایان</label>
        <input type="date" class="form-control" id="due_date" wire:model="due_date" required>
    </div>
    <div class="mb-3">
        <label for="priority" class="form-label">اولویت</label>
        <select class="form-select" id="priority" wire:model="priority" required>
            <option value="بالا">بالا</option>
            <option value="متوسط">متوسط</option>
            <option value="پایین">پایین</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">وضعیت</label>
        <select class="form-select" id="status" wire:model="status" required>
            <option value="در حال انجام">در حال انجام</option>
            <option value="به تعویق افتاده">به تعویق افتاده</option>
            <option value="کامل شده">کامل شده</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">ایجاد وظیفه</button>
</form>
