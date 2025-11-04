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

        $today = now()->toDateString();

        $exists = PKMStudentHabits::where('student_id', $user->id)
            ->whereDate('date', $today)
            ->exists();

        return response()->json(['canAdd' => !$exists]);
    }

}
