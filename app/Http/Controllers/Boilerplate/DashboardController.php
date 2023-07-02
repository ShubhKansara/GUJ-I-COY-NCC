<?php

namespace App\Http\Controllers\Boilerplate;

use App\Http\Controllers\Controller;
use App\Models\Boilerplate\Candidate;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\Boilerplate\Chatbot;
use App\Models\Boilerplate\Institute;
use App\Models\Boilerplate\QuestionType;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $institutes = Institute::where('status',1)->count();;
        $candidates = Candidate::count();
        return view('boilerplate::dashboard', [
            'institutes' => $institutes,
            'candidates' => $candidates
        ]);
    }

    public function demo()
    {
        return view('boilerplate::demo');
    }
}
