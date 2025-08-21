<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Certification;
use App\Models\UserCertification;
use App\Models\Result;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        

        // Load all certifications
        $certs = Certification::all();

        // Attach progress for each cert
        $certs = $certs->map(function ($cert) use ($user) {
            $results = Result::where('user_id', $user->id)
                ->where('certification_id', $cert->id)
                ->get();

            if ($results->count() > 0) {
                $first = $results->first()->score;
                $last = $results->last()->score;
                $best = $results->max('score');
                $progress = [
                    'first' => $first,
                    'last' => $last,
                    'best' => $best,
                ];
            } else {
                $progress = null;
            }

            $cert->progress = $progress;
            return $cert;
        });

        return view('dashboard', compact('certs'));
    }
}
