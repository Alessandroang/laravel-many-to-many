<?php

namespace App\Http\Controllers\Guest;

use App\Models\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
  public function index()
  {
    $projects = Project::orderby('id', 'desc')->paginate(6);

    return view('guest.home', compact('projects'));
  }
}
