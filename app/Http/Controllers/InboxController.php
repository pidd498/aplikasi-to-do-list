<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InboxController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;
        $userName = $user->name;
        $userEmail = $user->email;

        date_default_timezone_set('Asia/Jakarta');
        $currentDate = date('Y-m-d');

        $notificationCountTaskManager = DB::table('tasks')
            ->where('user_id', $userId)
            ->whereIn('status', ['Not Started', 'On Progres'])
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
            ->whereIn('status', ['Not Started', 'On Progres'])
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

        return view('inbox.index', compact(
            'userName',
            'userEmail',
            'notificationCount',
            'notifications'
        ));
    }
}