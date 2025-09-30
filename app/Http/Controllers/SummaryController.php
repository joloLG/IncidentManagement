<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\IncidentType;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\View;

class SummaryController extends Controller
{
    public function index(): View
    {
        $usersCount = User::count();
        $incidentTypesCount = IncidentType::count();
        $incidentsCount = Incident::count();
        $postsCount = Post::count();
        $latestPosts = Post::latest()->take(5)->get();
        $latestUsers = User::latest()->take(5)->get();
        $latestIncidentTypes = IncidentType::latest()->take(5)->get();

        return view('summary', [
            'usersCount' => $usersCount,
            'incidentTypesCount' => $incidentTypesCount,
            'incidentsCount' => $incidentsCount,
            'postsCount' => $postsCount,
            'latestPosts' => $latestPosts,
            'latestUsers' => $latestUsers,
            'latestIncidentTypes' => $latestIncidentTypes,
        ]);
    }
}
