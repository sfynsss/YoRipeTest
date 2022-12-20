<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;
use DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();

        if (count($data) > 0) {
			return response()->json(['message' => 'Data Found', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Not Found'], 401);
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|integer'
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
             ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => "Error ".$e], 500);
        }
        
        return response()->json(['message' => 'Store Data Successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::where('id', $id)->get();

        if (count($data) > 0) {
			return response()->json(['message' => 'Data Found', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Not Found'], 401);
		}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(),[
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|integer'
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        
        DB::beginTransaction();
        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->update();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => "Error ".$e], 500);
        }
        
        return response()->json(['message' => 'Updated Data Successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => 'required|integer'
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        
        DB::beginTransaction();
        try {
            $user = User::find($request->id);
            $user->delete();
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => "Error ".$e], 500);
        }
        
        return response()->json(['message' => 'Delete User Successfully'], 200);
    }
}
