<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table            = 'tasks';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['title', 'description', 'task_date', 'status', 'is_archived', 'created_at', 'updated_at'];
    protected $useTimestamps     = false;

    // Fetch active (non-archived) tasks
    public function getActiveTasks()
    {
        return $this->where('is_archived', 0)->findAll();
    }
}