<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
</head>
<body>
    <h2>Edit Task</h2>

    <?php if (isset($validation)): ?>
        <div style="color: red;"><?= $validation->listErrors() ?></div>
    <?php endif; ?>

    <form action="<?= site_url('tasks/update/' . $task['id']) ?>" method="post">
        <?= csrf_field() ?>

        <label>Task Title:</label><br>
        <input type="text" name="title" value="<?= set_value('title', $task['title']) ?>"><br><br>

        <label>Description:</label><br>
        <textarea name="description"><?= set_value('description', $task['description']) ?></textarea><br><br>

        <label>Task Date:</label><br>
        <input type="date" name="task_date" value="<?= set_value('task_date', $task['task_date']) ?>"><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="Pending" <?= $task['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
            <option value="In Progress" <?= $task['status'] === 'In Progress' ? 'selected' : '' ?>>In Progress</option>
            <option value="Completed" <?= $task['status'] === 'Completed' ? 'selected' : '' ?>>Completed</option>
        </select><br><br>

        <button type="submit">Update Task</button>
        <a href="<?= site_url('tasks') ?>">Cancel</a>
    </form>
</body>
</html>