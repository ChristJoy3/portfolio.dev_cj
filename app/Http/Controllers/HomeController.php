<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\JourneyMilestone;
use App\Models\Project;
use App\Models\Skill;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('welcome', [
            'about' => About::current(),
            'skills' => Skill::active()->ordered()->get(),
            'projects' => Project::active()->ordered()->get(),
            // Keyed by type so the Blade can pull each tab's list directly.
            'journey' => JourneyMilestone::active()->ordered()->get()->groupBy('type'),
        ]);
    }
}
