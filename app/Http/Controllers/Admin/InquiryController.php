<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\Inquiry; use Illuminate\Http\RedirectResponse; use Illuminate\Http\Request; use Inertia\Inertia; use Inertia\Response;
class InquiryController extends Controller { public function index(Request $r):Response{return Inertia::render('Admin/Inquiries',['inquiries'=>Inquiry::when($r->status,fn($q,$v)=>$q->where('status',$v))->latest()->paginate(20)]);} public function update(Request $r,Inquiry $inquiry):RedirectResponse{$inquiry->update($r->validate(['status'=>'required|in:new,in_progress,resolved,spam']));return back()->with('success','Inquiry status updated.');} }
