<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $data = Task::all();
        $response['message'] = true;
        $response['data']   = $data;
        $response['success'] = "Data Resource";
        return response()->json($response);
    }

    public function view($id)
    {
        $data = Task::find($id);
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
            'event_id' => 'required|integer',
            'name' => 'required',
            'date' => 'required',
        ]);
        if($validation->fails())
        {
            $response['success'] = false;
            $response['message'] = $validation->messages();
            $response['data']    = null;
        }else{
            $data = new Task();
            $data->event_id = $request->input('event_id');
            $data->name     = $request->input('name');
            $data->date     = $request->input('date');
            
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
        $data = Task::find($id);

        if($data)
        {
            $validation = \Validator::make($request->all(),[ 
                'event_id' => 'required|integer',
                'name' => 'required',
                'date' => 'required',
            ]);
            if($validation->fails())
            {
                $response['success'] = false;
                $response['message'] = $validation->messages();
                $response['data']    = null;
            }else{
                
                $data->event_id = $request->input('event_id');
                $data->name = $request->input('name');
                $data->date = $request->input('date');
                
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
        }else{
                    $response['message'] = "Maaf id = " .$id. " Tidak DTaskukan";
                    return response()->json($response);
        }

        

        return response()->json($response);
    }

    public function destroy($id)
    {
        $data = Task::find($id);

        if($data)
        {
            $data->delete();
            $response['message'] = true;
            $response['data']   = $data;
            $response['success'] = "Data successfull Deleted";
            return response()->json($response);
        }else{
            $response['message'] = "Maaf ID " .$id. " Tidak DTaskukan";
            return response()->json($response);
        }
        
    }
}
