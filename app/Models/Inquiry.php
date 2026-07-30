<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Inquiry extends Model { protected $fillable=['full_name','company_name','email','phone','service','subject','message','consent','status','ip_address']; protected function casts():array{return ['consent'=>'boolean'];} }
