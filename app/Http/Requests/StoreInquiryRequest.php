<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StoreInquiryRequest extends FormRequest { public function authorize():bool{return true;} public function rules():array{return ['full_name'=>['required','string','max:120'],'company_name'=>['nullable','string','max:160'],'email'=>['required','email:rfc','max:255'],'phone'=>['required','string','max:50'],'service'=>['nullable','string','max:100'],'subject'=>['required','string','max:160'],'message'=>['required','string','min:20','max:5000'],'consent'=>['accepted'],'website'=>['nullable','max:0']];} public function messages():array{return ['consent.accepted'=>'Please consent to the processing of your inquiry.'];} }
