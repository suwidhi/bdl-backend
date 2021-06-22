<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // list superuser and administrator but not regular one
        return User::where('type', 1)->orWhere('type', 2)->orWhere('type', 3)->orWhere('type', 4)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // we dont need password because we could use default password
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'type' => 'integer|required:in:1,2'
        ]);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'type' => $data['type'], # here we need to gettin serious..
            'password' => bcrypt('navi') # default password is navi for all user
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::where('id', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // super user cannot update anything screw you...
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User::where('id', $id)->first()->delete();
    }

    /**
     * get just the dealer account bruh...
     * what the hell is this good comment helper in vscode
     */

     public function accounts($type){
         // list all dealer account
        return User::where('type', $type)->get();
     }
}
