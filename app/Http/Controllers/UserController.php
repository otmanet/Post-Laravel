<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Post;

class UserController extends Controller
{
    function login(){
          return view('auth.login');
    }
    function register(){
        return view('auth.register');
    }
    function create(Request $request){
        $request->validate([
         'name'=>'required',
         'email'=>'required|email|unique:users',
         'password'=>'required|min:5|max:12'
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $query=$user->save();
        if($query){
            // return back()->with('success','You have been successfuly registered');
             if(Hash::check($request->password, $user->password)){
             $request->session()->put('LoggedUser',$user->id);
             return redirect('post');
             }
        }else{
            return back()->with('fail','Something went wrong');
        }
    }
    function verify_auth(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $user =User::where('email','=',$request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('LoggedUser',$user->id);
                return redirect('post');
            }else{
                return back()->with('fail','Invail Passsword');
            }
        }else{
            return back()->with('fail','No Account Find For This Email');
        }
    }
    function post(){
        if(session()->has('LoggedUser')){
                $user=User::where('id','=',session('LoggedUser'))->first();
                $post=Post::where('user_id','=',$user->id)->with('comments')->get();
                $data=[
                    'userPostInf'=>$user,
                    'posts'=>$post
                ];
        }
        return view('post.Userpost',$data);
    }
    function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('login');
        }
    }
 function ceratePost(Request $request){
     if(session()->has('LoggedUser')){
     $user=User::where('id','=',session('LoggedUser'))->first();
     $data=[
     'userPostInf'=>$user
     ];
     }
     return view('post.create',$data);
}
function addPost(Request $request, $id)
{
    $post=new Post();
  foreach ($request->photos as $photo) {
  $name_photo = $photo->getClientOriginalName();
  $photo->move(public_path() . '/files/', $name_photo);
  $data[] = $name_photo;
  $post::create([
      'name'=>$request->name,
      'photos' => $name_photo,
      'description'=>$request->description,
      'user_id' => $id
  ]);
  }
    return redirect('post');
}
function addComment(Request $request,$id){
    $comment=new Comment();
    $comment::create([
     'description'=>$request->description,
     'post_id'=>$id
    ]);
    return redirect('post');
}
}