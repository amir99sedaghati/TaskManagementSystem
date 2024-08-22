<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش وظیفه</title>
    <style>
        body {
            font-family: 'Tahoma', sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        input[type="text"], input[type="date"], select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>ویرایش وظیفه</h2>
        <form action="{{ url('/tasks/' . $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">عنوان:</label>
                <input type="text" id="title" name="title" value="{{ $task->title }}" required>
            </div>
            <div class="form-group">
                <label for="description">توضیحات:</label>
                <textarea id="description" name="description" rows="4">{{ $task->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="due_date">تاریخ پایان:</label>
                <input type="date" id="due_date" name="due_date" value="{{ $task->due_date }}" required>
            </div>
            <div class="form-group">
                <label for="priority">اولویت:</label>
                <select id="priority" name="priority" required>
                    <option value="بالا" {{ $task->priority == 'بالا' ? 'selected' : '' }}>بالا</option>
                    <option value="متوسط" {{ $task->priority == 'متوسط' ? 'selected' : '' }}>متوسط</option>
                    <option value="پایین" {{ $task->priority == 'پایین' ? 'selected' : '' }}>پایین</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">وضعیت:</label>
                <select id="status" name="status" required>
                    <option value="در حال انجام" {{ $task->status == 'در حال انجام' ? 'selected' : '' }}>در حال انجام</option>
                    <option value="به تعویق افتاده" {{ $task->status == 'به تعویق افتاده' ? 'selected' : '' }}>به تعویق افتاده</option>
                    <option value="کامل شده" {{ $task->status == 'کامل شده' ? 'selected' : '' }}>کامل شده</option>
                </select>
            </div>
            <button type="submit">بروزرسانی وظیفه</button>
        </form>
    </div>
</body>
</html>
