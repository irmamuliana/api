<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $data['user'] = User::all();
        $response['message'] = true;
        $response['data']   = $data;
        $response['success'] = "Data Resource";
        return response()->json($response);
    }

    public function view($id)
    {
        $user = User::find($id);
        if($data)
        {
            $response['message'] = true;
            $response['success'] = "Data Resource";
            $response['data']   = $data;
            
            return response()->json($response);
        }else{
            $response['message'] = "Maaf ID " .$id. " Tidak DItemukan";
            return response()->json($response);
        }
    }

    public function store(Request $request)
    {
        $validation = \Validator::make($request->all(),[ 
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'description' => 'required',
            'phone' => 'required',
            'linkedin' => 'required',
            'instagram' => 'required',
            'twitter' => 'required',
        ]);
        if($validation->fails())
        {
            $response['success'] = false;
            $response['message'] = $validation->messages();
            $response['data']    = null;
        }else{
            $data = new User();
            $data->name = $request->input('name');
            $data->username = $request->input('username');
            $data->email = $request->input('email');
            $data->password = Hash::make($request->input('password'));
            $data->description = $request->input('description');
            $data->phone = $request->input('phone');
            $data->linkedin = $request->input('linkedin');
            $data->instagram = $request->input('instagram');
            $data->twitter = $request->input('twitter');
            $data->token = 0;

            if($data->save()){
                $response['message'] = true;
                $response['data']   = $data;
                $response['success'] = "Data successfull created";
                return response()->json($response);
            }else{
                $response['message'] = false;
                $response['data']   = null;
                $response['success'] = "Data not found";
                return response()->json($response);
            }
        }

        return response()->json($response);

    }

    public function update(Request $request, $id)
    {
        $validation = \Validator::make($request->all(),[ 
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'description' => 'required',
            'phone' => 'required',
            'linkedin' => 'required',
            'instagram' => 'required',
            'twitter' => 'required',
        ]);
        if($validation->fails())
        {
            $response['success'] = false;
            $response['message'] = $validation->messages();
            $response['data']    = null;
        }else{
            $data = User::find($id);
            $data->name = $request->input('name');
            $data->username = $request->input('username');
            $data->email = $request->input('email');
            $data->password = Hash::make($request->input('password'));
            $data->description = $request->input('description');
            $data->phone = $request->input('phone');
            $data->linkedin = $request->input('linkedin');
            $data->instagram = $request->input('instagram');
            $data->twitter = $request->input('twitter');
            $data->token = 0;

            if($data->update()){
                $response['message'] = true;
                $response['data']   = $data;
                $response['success'] = "Data successfull created";
                return response()->json($response);
            }else{
                $response['message'] = false;
                $response['data']   = null;
                $response['success'] = "Data not found";
                return response()->json($response);
            }
        }

        return response()->json($response);
    }

    public function destroy($id)
    {
        $data = User::find($id);

        if($data)
        {
            $data->delete();
            $response['message'] = true;
            $response['data']   = $data;
            $response['success'] = "Data successfull Deleted";
            return response()->json($response);
        }else{
            $response['message'] = "Maaf ID " .$id. " Tidak DItemukan";
            return response()->json($response);
        }
        
    }

    public function Register(Request $request)
    {
        $validation = \Validator::make($request->all(),[ 
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'description' => 'required',
            'phone' => 'required',
            'linkedin' => 'required',
            'instagram' => 'required',
            'twitter' => 'required',
        ]);
        if($validation->fails())
        {
            $response['success'] = false;
            $response['message'] = $validation->messages();
            $response['data']    = null;
        }else{
            $data = new User();
            $data->name = $request->input('name');
            $data->username = $request->input('username');
            $data->email = $request->input('email');
            $data->password = Hash::make($request->input('password'));
            $data->description = $request->input('description');
            $data->phone = $request->input('phone');
            $data->linkedin = $request->input('linkedin');
            $data->instagram = $request->input('instagram');
            $data->twitter = $request->input('twitter');
            $data->token = 0;

            if($data->save()){
                $response['message'] = true;
                $response['data']   = $data;
                $response['success'] = "Data successfull created";
                return response()->json($response);
            }else{
                $response['message'] = false;
                $response['data']   = null;
                $response['success'] = "Data not found";
                return response()->json($response);
            }
        }

        return response()->json($response);
    }

    public function Login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', $username)->first();

        if($user)
        {
            if(!Hash::check($password, $user->password))
            {
                $response['message'] = "Maaf username " .$username. " Tidak di temukan";
                return response()->json($response, 404);
            }else{
                $token = utf8_decode(Str::random(40));

                $user->update([
                    'token' => $token,
                ]);


            $response['success'] = true;
            $response['message'] = "Welcome " . $user->name;
            $response['data']    = $user;
            $response['api_token'] = $token;
            return response()->json($response, 200);
            }
        }else{
            $response['message'] = "Maaf username " .$username. " Tidak di temukan";
                return response()->json($response, 404);
        }
    }
}
