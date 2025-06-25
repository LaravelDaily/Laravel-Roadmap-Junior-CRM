<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Notifications\TaskAssigned;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailTaskAssigned;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Task::with(['user', 'client', 'project'])
            ->filterStatus(request('status'))
            ->paginate(20);

        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create(): View
    {
        $users = User::all()->append('full_name');
        $clients = Client::all();
        $projects = Project::all();
        $statuses = TaskStatus::cases();

        return view('tasks.create', [
            'users' => $users,
            'clients' => $clients,
            'projects' => $projects,
            'statuses' => $statuses
        ]);
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $task = Task::create($request->validated());
        $user = User::find($request->user_id);

        $user->notify(new TaskAssigned($task));
        Mail::to($user)->send(new MailTaskAssigned($task));

        return redirect()->route('tasks.index')->with('status', 'Task created successfully');
    }

    public function show(Task $task): View
    {
        $task->load('user', 'client', 'project');

        return view('tasks.show', ['task' => $task]);
    }

    public function edit(Task $task): View
    {
        $users = User::all()->append('full_name');
        $clients = Client::all();
        $projects = Project::all();
        $statuses = TaskStatus::cases();

        return view('tasks.edit', [
            'task' => $task,
            'users' => $users,
            'clients' => $clients,
            'projects' => $projects,
            'statuses' => $statuses
        ]);
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        if ($task->user_id !== $request->user_id) {
            $user = User::find($request->user_id);

            $user->notify(new TaskAssigned($task));
            Mail::to($user)->send(new MailTaskAssigned($task));
        }

        $task->update($request->validated());

        return redirect()->route('tasks.index')->with('status', 'Task updated successfully');
    }

    public function destroy(Task $task): RedirectResponse
    {
        abort_if(Gate::denies('delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $task->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->back()->with('status', 'Task belongs to project. Cannot delete.');
            }
        }

        return redirect()->route('tasks.index')->with('status', 'Task deleted successfully');
    }
}
