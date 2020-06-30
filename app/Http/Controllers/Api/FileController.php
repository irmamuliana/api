<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\File;

class FileController extends Controller
{
    public function index()
    {
        $data = File::all();
        $response['message'] = true;
        $response['data']   = $data;
        $response['success'] = "Data Resource";
        return response()->json($response);
    }

    public function view($id)
    {
        $data = File::find($id);
        if($data)
        {
            $response['message'] = true;
            $response['success'] = "Data Resource";
            return response()->json($response);
            
            return response()->json($data);
        }else{
            $response['message'] = "Maaf ID " .$id. " Tidak DItemukan";
            return response()->json($response);
        }
    }

    public function store(Request $request)
    {
        $validation = \Validator::make($request->all(),[ 
            'event_id' => 'required|integer',
            'image' => 'required',
        ]);

        if($validation->fails())
        {
            $response['success'] = false;
            $response['message'] = $validation->messages();
            $response['data']    = null;
        }else{
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $file->move('Event', $fileName);

            $data = new File;
            $data->event_id = $request->event_id;
            $data->image = $fileName;
            $data->save();

            $response['success'] = true;
            $response['message'] = "Data Successfull Created!";
            $response['data']    = $data;
        }
        return response()->json($response);
    }

    public function update($id, Request $request)
    {
        $data = File::find($id);

        if($data)
        {
            $validation = \Validator::make($request->all(),[ 
                'event_id' => 'required|integer',
            ]);
    
            if($validation->fails())
            {
                $response['success'] = false;
                $response['message'] = $validation->messages();
                $response['data']    = null;
            }else{
    
                
                $data->event_id = $request->event_id;
                $data->update();
    
                $response['success'] = true;
                $response['message'] = "Data Successfull Created!";
                $response['data']    = $data;
            }
        }else{
                $response['message'] = "Maaf id = " .$id. " Tidak Ditemukan";
                    return response()->json($response);
        }

        
        return response()->json($response);
    }

    public function destroy($id)
    {
        $data = File::find($id);

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
}
