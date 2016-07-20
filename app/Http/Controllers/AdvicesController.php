<?php

namespace App\Http\Controllers;

use App\Advice;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdvicesController extends Controller
{
    public function index()
    {
        $advices = Advice::latest()->paginate(10);
        return view('advices.index',compact('advices'));
    }

    public function delete($id)
    {
        $flag = Advice::find($id);
        if($flag == 1){
            return redirect()->route('advices.index');
        }
    }
}
