<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        // Get user data from Auth (bukan Session)
        $user = Auth::user();
        $userId = $user->id;
        $userName = $user->name;
        $userEmail = $user->email;

        // Set timezone
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = date('Y-m-d');

        // Get notification count from tasks table
        $notificationCountTaskManager = DB::table('tasks')
            ->where('user_id', $userId)
            ->whereIn('status', ['Not Started', 'On Progres'])
            ->whereRaw('DATEDIFF(end_time, ?) IN (-1, 0, 1, 2, 3)', [$currentDate])
            ->count();

        // Get notification count from todos table
        $notificationCountTask = DB::table('todos')
            ->where('user_id', $userId)
            ->whereDate('tanggal', $currentDate)
            ->count();

        // Total notification count
        $notificationCount = $notificationCountTaskManager + $notificationCountTask;

        // Get notifications from tasks table
        $taskManagerNotifications = DB::table('tasks')
            ->select('task_name', DB::raw('DATEDIFF(end_time, "' . $currentDate . '") AS interval_tgl'))
            ->where('user_id', $userId)
            ->whereIn('status', ['Not Started', 'On Progres'])
            ->whereRaw('DATEDIFF(end_time, ?) IN (0, 1, 2, 3, -1)', [$currentDate])
            ->get();

        // Get notifications from todos table
        $taskNotifications = DB::table('todos')
            ->select('title as task_name')
            ->where('user_id', $userId)
            ->whereDate('tanggal', $currentDate)
            ->get();

        // Combine notifications
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

        // Get filter parameters
        $filter = $request->get('filter', 'All');
        $tanggalMulai = $request->get('tanggal_mulai', '');
        $tanggalSelesai = $request->get('tanggal_selesai', '');

        // Build query for tasks table (My Task)
        $taskManagerQuery = DB::table('tasks')
            ->select(
                'id as task_id',
                'task_name',
                'created_at',
                'status',
                DB::raw("'My Task' as category"),
                DB::raw('NULL as task_date')
            )
            ->where('user_id', $userId);

        // Build query for todos table (My Todo)
        $taskQuery = DB::table('todos')
            ->select(
                'id as task_id',
                'title as task_name',
                'created_at',
                DB::raw("CASE 
                    WHEN is_completed = 1 THEN 'Completed'
                    ELSE 'Not Finished'
                END as status"),
                DB::raw("'My Todo' as category"),
                'tanggal as task_date'
            )
            ->where('user_id', $userId);

        // Apply date filter if exists
        if ($tanggalMulai && $tanggalSelesai) {
            $taskManagerQuery->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai]);
            $taskQuery->whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai]);
        }

        // Apply filter based on selection
        if ($filter == 'Task') {
            $tasks = $taskManagerQuery->orderBy('created_at', 'desc')->get();
        } elseif ($filter == 'Todo') {
            $tasks = $taskQuery->orderBy('tanggal', 'desc')->get();
        } else {
            // Combine both queries
            $taskManagerResults = $taskManagerQuery->orderBy('created_at', 'desc')->get();
            $taskResults = $taskQuery->orderBy('tanggal', 'desc')->get();
            
            // Merge collections and sort by created_at
            $tasks = $taskManagerResults->merge($taskResults)->sortByDesc('created_at')->values();
        }

        return view('history.index', compact(
            'userName',
            'userEmail',
            'notificationCount',
            'notifications',
            'tasks',
            'filter',
            'tanggalMulai',
            'tanggalSelesai'
        ));
    }
}