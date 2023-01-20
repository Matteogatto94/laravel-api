<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Project::with(['category', 'technologies'])->orderByDesc('id')->get()
        ]);
    }

    public function show($slug)
    {
        //dd($slug);

        $project = Project::with('category', 'technologies')->where('slug', $slug)->first();
        //dd($project);

        if ($project) {
            return response()->json([
                'success' => true,
                'project' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Project Not Found'
            ]);
        }
    }
}
