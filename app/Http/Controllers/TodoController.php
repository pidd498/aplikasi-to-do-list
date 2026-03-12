<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
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

        $todos = DB::table('todos')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('todos.index', compact(
            'userName',
            'userEmail',
            'notificationCount',
            'todos'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'tanggal' => 'nullable|date',
        ]);

        DB::table('todos')->insert([
            'user_id'      => Auth::id(),
            'title'        => $request->title,
            'tanggal'      => $request->tanggal,
            'is_completed' => false,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        return redirect()->route('todos.index')->with('success', 'Todo berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $userId = Auth::id();

        // Ambil todo yang ada
        $todo = DB::table('todos')->where('id', $id)->where('user_id', $userId)->first();

        if (!$todo) {
            abort(404);
        }

        // Toggle is_completed
        DB::table('todos')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->update([
                'is_completed' => !$todo->is_completed,
                'updated_at'   => now(),
            ]);

        return redirect()->route('todos.index')->with('success', 'Todo berhasil diupdate!');
    }

    public function destroy($id)
    {
        DB::table('todos')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()->route('todos.index')->with('success', 'Todo berhasil dihapus!');
    }
}
