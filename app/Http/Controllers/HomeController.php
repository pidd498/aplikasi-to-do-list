<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;
        $userName = $user->name;
        $userEmail = $user->email;

        date_default_timezone_set('Asia/Makassar');
        $currentDate = date('Y-m-d');

        // Get notification count
        $notificationCountTaskManager = DB::table('tasks')
            ->where('user_id', $userId)
            ->whereIn('status', ['Not started', 'On Progres'])
            ->whereRaw('DATEDIFF(end_time, ?) IN (-1, 0, 1, 2, 3)', [$currentDate])
            ->count();

        $notificationCountTask = DB::table('todos')
            ->where('user_id', $userId)
            ->whereDate('tanggal', $currentDate)
            ->count();

        $notificationCount = $notificationCountTaskManager + $notificationCountTask;

        // Get notifications
        $taskManagerNotifications = DB::table('tasks')
            ->select('task_name', DB::raw('DATEDIFF(end_time, "' . $currentDate . '") AS interval_tgl'))
            ->where('user_id', $userId)
            ->whereIn('status', ['Not started', 'On Progres'])
            ->whereRaw('DATEDIFF(end_time, ?) IN (0, 1, 2, 3, -1)', [$currentDate])
            ->get();

        $taskNotifications = DB::table('todos')
            ->select('title as task_name')
            ->where('user_id', $userId)
            ->whereDate('tanggal', $currentDate)
            ->get();

        $notifications = [];
        foreach ($taskManagerNotifications as $task) {
            $notifications[] = [
                'message' => $task->task_name,
                'interval' => $task->interval_tgl,
                'type' => 'task_manager'
            ];
        }
        foreach ($taskNotifications as $task) {
            $notifications[] = [
                'message' => $task->task_name,
                'type' => 'task'
            ];
        }

        // Get tasks dan todos
        $tasks = DB::table('tasks')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function($task) {
                if ($task->start_time) {
                    $task->start_time = \Carbon\Carbon::parse($task->start_time);
                }
                if ($task->end_time) {
                    $task->end_time = \Carbon\Carbon::parse($task->end_time);
                }
                if ($task->created_at) {
                    $task->created_at = \Carbon\Carbon::parse($task->created_at);
                }
                return $task;
            });

        $todos = DB::table('todos')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function($todo) {
                if ($todo->tanggal) {
                    $todo->tanggal = \Carbon\Carbon::parse($todo->tanggal);
                }
                if ($todo->created_at) {
                    $todo->created_at = \Carbon\Carbon::parse($todo->created_at);
                }
                return $todo;
            });

        // Get user stats
        $totalTasks = DB::table('tasks')->where('user_id', $userId)->count();
        $totalTodos = DB::table('todos')->where('user_id', $userId)->count();
        $completedTasks = DB::table('tasks')->where('user_id', $userId)->where('status', 'Done')->count();
        $completedTodos = DB::table('todos')->where('user_id', $userId)->where('is_completed', true)->count();

        return view('home.index', compact(
            'userName',
            'userEmail',
            'notificationCount',
            'notifications',
            'tasks',
            'todos',
            'totalTasks',
            'totalTodos',
            'completedTasks',
            'completedTodos'
        ));
    }
}