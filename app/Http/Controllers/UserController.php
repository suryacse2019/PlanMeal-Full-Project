<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $userlist = User::all();
        

        return view('user.index', compact('userlist'));
    }


    public function create()
    {
        $role = Role::all();
        return view('user.create', compact('role'));
    }

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('user.index')->with('success','User Created successfully');
    }

    /**

     * Display the specified resource.
     *
     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        //

    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {
        $user = User::find($id);
        $rolelist = Role::all();

        return view('user.edit', compact('user', 'rolelist'));
    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)

    {

        $user = user::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role;
        $user->status = $request->status;
        $user->update();

        return redirect()->route('user.index')->with('success','User details Updated successfully!!');
    }

    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('user.index')->with('success','Record delete successfully');

    }
}
