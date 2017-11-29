<?php

namespace App\Http\Controllers\Admin;
use App\Meun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PublicController extends Controller
{
    //
    public function index(Request $request)
    {
//        echo json_encode($request->getSession()->all());
        exit;
        return view('main');
    }
}
