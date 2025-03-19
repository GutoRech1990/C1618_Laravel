<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $title = 'Available Jobs';
        $availableJobs = [
            'Backend Developer',
            'Frontend Developer',
            'UI/UX Designer',
            'DevOps Engineer',
            'Data Scientist',
            'Machine Learning Engineer',
            'Mobile Developer',
            'Product Manager',
            'Project Manager',
            'QA Engineer',
            'Security Engineer',
            'Software Engineer',
            'System Administrator',
            'Technical Support',
            'Web Developer',
        ];
        return view('jobs.index', compact('title', 'availableJobs'));
    }
}
