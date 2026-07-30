<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Content extends Model { protected $table='contents'; protected $fillable=['type','category_id','title','slug','summary','content','featured_image','status','sort_order','is_featured','published_at','meta_title','meta_description','created_by','updated_by']; protected function casts():array{return ['is_featured'=>'boolean','published_at'=>'datetime'];} public function scopePublished($q){return $q->where('status','published')->where(fn($q)=>$q->whereNull('published_at')->orWhere('published_at','<=',now()));} public function category(){return $this->belongsTo(self::class,'category_id');} }
