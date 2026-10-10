<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
</head>
<body>
    <div style="background: #f4f4f4; padding: 10px; margin-bottom: 20px;">
        <strong>Tasks System</strong> | 
        <a href="<?= site_url('tasks') ?>">Task List</a>
        <?php if (session()->get('isLoggedIn')): ?>
            | <a href="<?= site_url('tasks/new') ?>">+ Add Task</a>
            | <a href="<?= site_url('logout') ?>" style="color: red; float: right;">Logout</a>
        <?php else: ?>
            | <a href="<?= site_url('login') ?>" style="float: right;">Login</a>
        <?php endif; ?>
    </div>

    <h2><?= esc($title) ?></h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Task Date</th>
                <th>Status</th>
                <?php if (session()->get('isLoggedIn')): ?>
                    <th>Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($tasks)): ?>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= esc($task['title']) ?></td>
                        <td><?= esc($task['description']) ?></td>
                        <td><?= esc($task['task_date']) ?></td>
                        <td><?= esc($task['status']) ?></td>
                        <?php if (session()->get('isLoggedIn')): ?>
                            <td>
                                <a href="<?= site_url('tasks/edit/' . $task['id']) ?>">Edit</a> | 
                                <a href="<?= site_url('tasks/archive/' . $task['id']) ?>" onclick="return confirm('Archive this task?')">Archive</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No active tasks found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>