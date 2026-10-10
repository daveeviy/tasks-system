<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Tasks extends BaseController
{
    protected $taskModel;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->taskModel = new TaskModel();
        helper('form');
    }

    // Public list of active (non-archived) tasks
    public function index()
    {
        $data['title'] = 'Tasks for Today';
        $data['tasks'] = $this->taskModel->getActiveTasks();
        return view('tasks/index', $data);
    }

    // Protected: Add new task form
    public function new()
    {
        $data['title'] = 'Add New Task';
        return view('tasks/create', $data);
    }

    // Protected: Process new task creation with validation
    public function create()
    {
        $rules = [
            'title'     => 'required|min_length[3]',
            'task_date' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return view('tasks/create', [
                'title'      => 'Add New Task',
                'validation' => $this->validator
            ]);
        }

        $this->taskModel->save([
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'task_date'   => $this->request->getPost('task_date'),
            'status'      => $this->request->getPost('status') ?? 'Pending',
            'is_archived' => 0
        ]);

        return redirect()->to('/tasks');
    }

    // Protected: Edit task form
    public function edit($id)
    {
        $data['title'] = 'Edit Task';
        $data['task']  = $this->taskModel->find($id);
        return view('tasks/edit', $data);
    }

    // Protected: Process task update with validation
    public function update($id)
    {
        $rules = [
            'title'     => 'required|min_length[3]',
            'task_date' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return view('tasks/edit', [
                'title'      => 'Edit Task',
                'task'       => $this->taskModel->find($id),
                'validation' => $this->validator
            ]);
        }

        $this->taskModel->update($id, [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'task_date'   => $this->request->getPost('task_date'),
            'status'      => $this->request->getPost('status')
        ]);

        return redirect()->to('/tasks');
    }

    // Protected: Soft Delete (Sets is_archived = 1)
    public function archive($id)
    {
        $this->taskModel->update($id, ['is_archived' => 1]);
        return redirect()->to('/tasks');
    }
}