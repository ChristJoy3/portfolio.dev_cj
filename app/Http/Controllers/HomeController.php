<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\JourneyMilestone;
use App\Models\Project;
use App\Models\SidebarProfile;
use App\Models\SidebarSkill;
use App\Models\Skill;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('welcome', [
            'about' => About::current(),
            'sidebar' => SidebarProfile::current(),
            // Keyed by group (language / core / extended) so the Blade can pull each block directly.
            'sidebarSkills' => SidebarSkill::active()->ordered()->get()->groupBy('group'),
            'skills' => Skill::active()->ordered()->get(),
            'projects' => Project::active()->ordered()->get(),
            // Keyed by type so the Blade can pull each tab's list directly.
            'journey' => JourneyMilestone::active()->ordered()->get()->groupBy('type'),
        ]);
    }
}
