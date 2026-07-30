<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Setting extends Model { public $timestamps=false; protected $fillable=['key','value','group']; public static function values():array{return static::pluck('value','key')->all();} }
