<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\RawMaterial;
use App\Models\ChildPartNumber;
use App\Models\Nesting;
use App\Models\Operation;
use Illuminate\Http\Request;
use Milon\Barcode\DNS2D;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dns2d = new DNS2D;
        \Storage::disk('public')->put('test.png',base64_decode($dns2d->getBarcodePNG("4", "PDF417")));
        $users = User::count();
        $user_lists = User::all();
        $child_part_numbers = ChildPartNumber::count();
        $raw_materials = RawMaterial::count();
        $nestings = Nesting::count();
        $operations = Operation::count();
        return view('home',compact('users','child_part_numbers','raw_materials','nestings','operations','user_lists'));
    }
}
