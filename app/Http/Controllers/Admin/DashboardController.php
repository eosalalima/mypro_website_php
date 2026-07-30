<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\Content; use App\Models\Inquiry; use Inertia\Inertia; use Inertia\Response;
class DashboardController extends Controller { public function __invoke():Response{return Inertia::render('Admin/Dashboard',['stats'=>['published'=>Content::where('status','published')->count(),'drafts'=>Content::where('status','draft')->count(),'newInquiries'=>Inquiry::where('status','new')->count(),'totalContent'=>Content::count()],'recentInquiries'=>Inquiry::latest()->take(5)->get()]);} }
