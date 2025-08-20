<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\UserCertification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
  public function index(){
    $certs = Certification::orderBy('is_active','desc')->get();
    return view('certifications.index', compact('certs'));
  }

  public function show(Certification $certification){
    $certification->load('domains.topics');
    return view('certifications.show', compact('certification'));
  }

  public function activate(Certification $certification){
    $user = auth()->user();
    if ($user->tier === 'free') {
      $count = UserCertification::where('user_id',$user->id)->count();
      if ($count >= 1) return back()->with('error','Free plan allows only one active certification. Upgrade to Pro.');
    }
    UserCertification::firstOrCreate([
      'user_id'=>$user->id,'certification_id'=>$certification->id
    ]);
    return redirect()->route('certifications.show',$certification);
  }
  
  public function show($slug){
    $cert = Certification::where('slug', $slug)
        ->with('domains.topics.questions')
        ->firstOrFail();

    return view('certifications.show', compact('cert'));
	}
}
