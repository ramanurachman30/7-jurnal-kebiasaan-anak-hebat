<?php

namespace App\Http\Controllers\Api;

use App\Models\PKMStudentHabits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PKMStudentHabitsController extends ApiGlobalController
{
    //
    public function checkToday(Request $request)
    {
        $user = auth()->user();

        // hanya untuk murid
        if ($user->role != 2) {
            return response()->json(['canAdd' => true]);
        }

        // gunakan timezone lokal
        $today = now('Asia/Jakarta')->toDateString();

        // jika user mengirim tanggal tertentu, gunakan itu
        $date = $request->input('date', $today);

        // cek apakah sudah ada data untuk tanggal tersebut
        $exists = PKMStudentHabits::where('student_id', $user->id)
            ->whereDate('date', $date)
            ->exists();

        return response()->json(['canAdd' => !$exists]);
    }

}
