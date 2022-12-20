<?php

namespace App\Http\Controllers\API;

use App\Models\Posts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

class PostsController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 1 || Auth::user()->role == 2) {
            $data = Posts::all();
        } else {
            $data = Posts::where('id_user', Auth::user()->id)->get();
        }
        
        if (count($data) > 0) {
            return response()->json(['message' => 'Data Found', 'data' => $data], 200);
        } else {
            return response()->json(['message' => 'Data Not Found'], 401);
        }
    }
    
    public function show($id)
    {
        if (Auth::user()->role == 1 || Auth::user()->role == 2) {
            if (isset($id)) {
                $data = Posts::where('id', $id)->get();
            } else {
                $data = Posts::all();
            }
        } else {
            if (isset($id)) {
                $data = Posts::where('id', $id)->where('id_user', Auth::user()->id)->get();
            } else {
                $data = Posts::where('id_user', Auth::user()->id)->get();
            }
        }
        
        if (count($data) > 0) {
            return response()->json(['message' => 'Data Found', 'data' => $data], 200);
        } else {
            return response()->json(['message' => 'Data Not Found'], 401);
        }
    }
    
    public function store(Request $request, Posts $post)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:255|'
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        
        DB::beginTransaction();
        try {
            $post->title = $request->title;
            $post->content = $request->content;
            
            if (Auth::user()->role == 1 || Auth::user()->role == 2) {
                if (isset($request->id_user)) {
                    $post->id_user = $request->id_user;
                } else {
                    $post->id_user = Auth::user()->id;
                }
            } else {
                $post->id_user = Auth::user()->id;
            }
            
            $post->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e], 500);
        }
        
        return response()->json(['message' => 'Store Data Successfully'], 200);
    }
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => 'required|integer',
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:255|'
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        
        DB::beginTransaction();
        try {
            if (Auth::user()->role == 1 || Auth::user()->role == 2) {
                $post = Posts::find($request->id);
                $post->title = $request->title;
                $post->content = $request->content;
                $post->update();
            } else {
                $update = Posts::where('id', $request->id)->where('id_user', Auth::user()->id)->update([
                    'title' => $request->title,
                    'content' => $request->content
                ]);

                if (!$update) {
                    return response()->json(['message' => "Updated Data Failed"], 500);
                }
            }
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => "Error ".$e], 500);
        }
        
        return response()->json(['message' => 'Updated Data Successfully'], 200);
    }

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
            if (Auth::user()->role == 1 || Auth::user()->role == 2) {
                $post = Posts::find($request->id);
                $post->delete();
            } else {
                $delete = Posts::where('id', $request->id)->where('id_user', Auth::user()->id)->delete();

                if (!$delete) {
                    return response()->json(['message' => "Delete Data Failed"], 500);
                }
            }
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => "Error ".$e], 500);
        }
        
        return response()->json(['message' => 'Delete Data Successfully'], 200);
    }
}
