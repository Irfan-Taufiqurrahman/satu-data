<?php

namespace App\Http\Controllers\api;

use App\Models\SubTopic;
use App\Models\TopicData;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class TSubTopicController extends Controller
{
    public function index(Request $request)
    {
        $subtopic = SubTopic::all();
        $id = $request->input('id');

        if ($id) {
            $subtopic = SubTopic::find($id);
            if ($subtopic) {
                return ResponseFormatter::success([
                    'data' => $subtopic,
                    'message' => 'Data subtopic Berhasil diambil',
                ]);
            } else {
                return ResponseFormatter::error(404, 'Data subtopic tidak ditemukan');
            }
        }
        return ResponseFormatter::success([
            'data' => $subtopic,
            'message' => 'Data Berhasil diambil',
        ]);
    }

    public function show(Request $request, $id)
    {
        // $validator = Validator::make($request->all(), [
        //     'code_subtopic' => 'required',
        //     'title' => 'required',
        //     'result' => 'required'
        // ]);

        $subtopic = SubTopic::findOrFail($id);

        $error = ResponseFormatter::error([
            'message' => 'something went wrong',
        ], 'Subtopic data not found', 500);
        if (is_null($subtopic)) {
            return ResponseFormatter::error([
                'message' => 'something went wrong',
            ], 'Subtopic data is null', 422);
        }
        return response()->json([
            'message' => 'Show Subtopic Data  Successful',
            'data' => $subtopic,
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code_subtopic' => 'required',
            'code_topic' => 'required',
            'title' => 'required',
            'result' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation',
                'error' => $validator->errors(),
            ], 422);
        }

        $subtopic = SubTopic::create([
            'code_subtopic' => $request->code_subtopic,
            'code_topic' => $request->code_topic,
            'title' => $request->title,
            'result' => $request->result,
        ]);

        return response()->json([
            'message' => 'Create Topic Data successful',
            'data' => $subtopic,
        ], 200);
    }

    public function update(Request $request, $id)
    {   
        $subtopic = SubTopic::find($id);
        if(is_null($subtopic)){
            return ResponseFormatter::error([
                'message' => 'Subtopic data is null',
            ], `something went error`, 422);
        } else{
        $validator = Validator::make($request->all(), [
            'code_topic' => 'required',
            'title' => 'required',
            'result' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation',
                'error' => $validator->errors(),
            ], 422);
        }

        $subtopic = SubTopic::findOrFail($id);

        $subtopic->update([
            'code_topic' => $request->code_topic,
            'title' => $request->title,
            'result' => $request->result,
        ]);

        $subtopic = SubTopic::where('code_topic', '=', $subtopic->code_subtopic)->get();

        return response()->json([
            'message' => 'Update subtopic Data Successful',
            'data' => $subtopic,
        ], 200);
     }
    }

    public function delete($id)
    {
        try {
            $subtopic = SubTopic::find($id);
            $subtopic->delete();
            return ResponseFormatter::success([
                'message' => 'Subtopic data deleted successful',
            ], 'Topic data deleted succesfull', 500);
        } catch (QueryException $error) {
            return ResponseFormatter::error([
                'message' => 'something went wrong',
                'error' => $error,
            ], 'Subtopic Data not deleted', 500);
        }
    }
}
