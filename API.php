<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class API extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
          $user = DB::table('users')->get();
          return response()->json($user, Response::HTTP_OK);
        } catch(QueryException $e) {
           $error = [
            'error'=>$e->message()
           ];
           return response()->json($error);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) 
    {
        //
        $waktu = Carbon::now();

        try {

            $user = DB::table('users')->insert([
                'email'=>$request->email,
                'password'=>$request->password,
                'username'=>$request->username,
                'gender'=>$request->gender,
                'handphone'=>$request->handphone,
                'audit_date'=>$waktu,
            ]);
            return response()->json($user, Response::HTTP_OK);
        } catch(QueryException $e) {
            $error = [
            'error'=>$e->message()
            ];    
            return response()->json($error); 
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        //   DB::table('users')->where('rowID', $request->id)->update([
        //       'email'
        //   ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        try {

            $waktu = Carbon::now();

            $user = DB::table('users')->where('rowID', $request->id)->update([
                'email'=>$request->email,
                'password'=>$request->password,
                'username'=>$request->username,
                'gender'=>$request->gender,
                'handphone'=>$request->handphone,
                'audit_date'=>$waktu,
            ]);

            return response()->json($user, Response::HTTP_OK);

        } catch(QueryException $e) {
            $error = [
                'error'=>$e->message()
            ];

            return response()->json($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
          $user = DB::table('users')->where('rowID', $id)->delete();
          return response()->json($user, Response::HTTP_OK);
        } catch(QueryException $e) {
          $error = [
            'error'=>$e->message()
          ];
          return response()->json($error);
        }
    }

    public function login(Request $request) 
    {
        try {
            $user = DB::table('users')->where('email', $request->email)->where('password', $request->password)->get();
            return Response()->json($user, Response::HTTP_OK);
        } catch (QueryException $e) {
            $error = [
                'error'=>$e->message()
            ];
            return response()->json($error);
        }
    }
}
