<?php
namespace Tests\Feature;
use App\Models\Content; use Illuminate\Foundation\Testing\RefreshDatabase; use Tests\TestCase;
class PublicWebsiteTest extends TestCase {use RefreshDatabase; public function test_home_page_loads():void{$this->seed();$this->get('/')->assertOk()->assertInertia(fn($p)=>$p->component('Public/Home')->has('services',5));} public function test_published_page_loads_and_draft_does_not():void{Content::create(['type'=>'page','title'=>'Visible','slug'=>'visible','status'=>'published']);Content::create(['type'=>'page','title'=>'Hidden','slug'=>'hidden','status'=>'draft']);$this->get('/visible')->assertOk();$this->get('/hidden')->assertNotFound();}}
