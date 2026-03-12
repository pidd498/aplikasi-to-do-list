<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
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

        $tasks = DB::table('tasks')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
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

        return view('tasks.index', compact(
            'userName',
            'userEmail',
            'notificationCount',
            'tasks'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_name'   => 'required|string|max:255',
            'start_time'  => 'required|date',
            'end_time'    => 'required|date|after_or_equal:start_time',
            'status'      => 'required|string',
            'description' => 'nullable|string',
        ]);

        DB::table('tasks')->insert([
            'user_id'     => Auth::id(),
            'task_name'   => $request->task_name,
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'status'      => $request->status,
            'description' => $request->description,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'task_name'   => 'required|string|max:255',
            'start_time'  => 'required|date',
            'end_time'    => 'required|date|after_or_equal:start_time',
            'status'      => 'required|string',
            'description' => 'nullable|string',
        ]);

        DB::table('tasks')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->update([
                'task_name'   => $request->task_name,
                'start_time'  => $request->start_time,
                'end_time'    => $request->end_time,
                'status'      => $request->status,
                'description' => $request->description,
                'updated_at'  => now(),
            ]);

        return redirect()->route('tasks.index')->with('success', 'Task berhasil diupdate!');
    }

    public function destroy($id)
    {
        DB::table('tasks')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()->route('tasks.index')->with('success', 'Task berhasil dihapus!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        DB::table('tasks')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->update([
                'status'     => $request->status,
                'updated_at' => now(),
            ]);

        return response()->json(['success' => true]);
    }
}
