<?php
namespace App\Http\Controllers;

use App\Models\Peternak;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index($id)
    {
        if(view()->exists('pages/'.$id)){
            // return $id;
            
            return view('pages/'.$id);
        }
        else
        {
            return view('404');
        }

     
    }
}
