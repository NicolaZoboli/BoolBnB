<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Property;
use App\Property_Request;

class UprController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  // Show Dashboard
  public function show()
  {
    $properties = Property::where('user_id', '=', Auth::id()) -> get();
    $requests = Property_Request::where('user_id', '=', Auth::id()) -> get();
    
    return view('dashboard', compact('properties', 'requests'));
  }

  // Form di aggiornamento
  public function update(){
    return view('upr-update');
  }

  public function create()
  {
    return view('create-property');
  }
}
