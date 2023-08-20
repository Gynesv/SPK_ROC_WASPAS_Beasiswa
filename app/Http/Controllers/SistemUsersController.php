<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SistemApp;

use App\Models\SistemUsers;
use DB;

class SistemUsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    # FUNGSI INDEX

    public function index()
    {
        $app    = SistemApp::sistem();
        return view('sistem_users.index', compact('app'));
    }

    # FUNGSI VIEW (READ)

    public function view()
    {
        $result = array('success' => false);

        try {

            $data = SistemUsers::get();

            $data = $data->map(function ($value){

                $value->level       = format_level_user($value->level);

                return $value;
            });
            
        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();
            return response()->json($result);
        }

        $result['success'] = true;
        $result['data'] = $data;

        return response()->json($result);
    }

    public function save(Request $r)
    {
        
            $transaction = DB::connection('mysql')->transaction(function() use($r){              
    
                $tmp                    = new SistemUsers();
                $tmp->name              = $r->nama;
                $tmp->username          = $r->username;
                $tmp->email             = $r->email;
                $tmp->level             = $r->level;
                $tmp->password          = bcrypt($r->password);
                $tmp->password_view     = $r->password;

                $tmp->save();
    
                return true;
            });

        return response()->json($transaction);
    }

    public function edit(Request $r)
    {
        $id = $r->get('id');
        $data = SistemUsers::where('id', $id)->first();
        return response()->json($data);
    }

    public function update(Request $r)
    {

        $data = DB::connection('mysql')->transaction(function () use ($r) {

            $id = $r->get('id');
            $tmp = SistemUsers::where('id', $id)->first();
            $tmp->password          = bcrypt($r->password);
            $tmp->password_view     = $r->password;
            $tmp->save();

            return true;
        });

        return response()->json($data);
    }

}
