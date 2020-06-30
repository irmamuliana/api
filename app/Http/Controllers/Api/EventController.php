<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $data = Event::all();

        $response['message'] = true;
        $response['data']   = $data;
        $response['success'] = "Data Resource";
        return response()->json($response);
    }

    public function view($id)
    {
        $data = Event::find($id);

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
            'user_id' => 'required|integer',
            'event_name' => 'required',
            'description' => 'required',
            'date' => 'required',
        ]);
        if($validation->fails())
        {
            $response['success'] = false;
            $response['message'] = $validation->messages();
            $response['data']    = null;
        }else{
            $data = new Event();
            $data->user_id = $request->input('user_id');
            $data->event_name = $request->input('event_name');
            $data->description = $request->input('description');
            $data->date = $request->input('date');
            
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
        $data = Event::find($id);

        if($data)
        {
            $validation = \Validator::make($request->all(),[ 
                'user_id' => 'required|integer',
                'event_name' => 'required',
                'description' => 'required',
                'date' => 'required',
            ]);
            if($validation->fails())
            {
                $response['success'] = false;
                $response['message'] = $validation->messages();
                $response['data']    = null;
            }else{
                
                $data->user_id = $request->input('user_id');
                $data->event_name = $request->input('event_id');
                $data->description = $request->input('description');
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
            $response['message'] = "Maaf id = " .$id. " Tidak Ditemukan";
                    return response()->json($response);
        }

        

        return response()->json($response);
    }

    public function destroy($id)
    {
        $data = Event::find($id);

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
