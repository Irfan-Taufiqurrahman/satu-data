<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ThematicData;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TThematicDataController extends Controller
{

    public function index(Request $request)
    {
        $thematic = ThematicData::all();
        $id = $request->input('id');
        if ($id) {
            $thematic = ThematicData::find($id);
            if ($thematic) {
                return ResponseFormatter::success([
                    'data' => $thematic,
                    'message' => 'Data Thematic Berhasil diambil',
                ]);
            } else {
                return ResponseFormatter::error(404, 'Data Thematic tidak ditemukan');
            }
        }
        return ResponseFormatter::success([
            'data' => $thematic,
            'message' => 'Data Berhasil diambil',
        ]);

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code_thematic' => 'required|int|max:100',
            'title_thematic' => 'required|string',
            'name_opd' => 'required|string',
            'main_code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation',
                'error' => $validator->errors(),
            ], 422);
        }

        $thematic = ThematicData::create([
            'code_thematic' => $request->code_thematic,
            'title_thematic' => $request->title_thematic,
            'main_code' => $request->main_code,
            'name_opd' => $request->name_opd,
        ]);

        return response()->json([
            'message' => 'Create Thematic Data Successful',
            'data' => $thematic,
        ], 200);
    }

    public function show(Request $request, $id)
    {
        // $validator = Validator::make($request->all(), [
        //         'code_thematic' => 'required|integer',
        //         'title_thematic' => 'required',
        //         'name_opd' => 'required',
        //     ]);
        $thematic = Thematicdata::findOrFail($id);
        $error=ResponseFormatter::error();
        if (is_null($thematic)) {
            return ResponseFormatter::error([
                'message' => 'something went wrong',
            ], 'Thematic data is null ', 422);
        } else {
            return response()->json([
                'message' => 'Show Data Thematic Successful',
                'data' => $thematic,
            ], 200);
        }
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title_thematic' => 'required',
            'name_opd' => 'required',
            'main_code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation',
                'error' => $validator->errors(),
            ], 422);
        }

        $thematic = ThematicData::findOrFail($id);

        $thematic->update([
            'title_thematic' => $request->title_thematic,
            'name_opd' => $request->name_opd,
            'main_code'=> $request->main_code
        ]);

        $thematic = ThematicData::where('code_thematic', '=', $thematic->code_thematic)->get();

        return response()->json([
            'message' => 'Update Thematic Data Successful',
            'data' => $thematic,
        ], 200);
    }

    public function delete($id)
    {
        try {
            $thematic = ThematicData::find($id);
            $thematic->delete();
            return ResponseFormatter::success([
                'message' => 'Thematic data deleted successful',
            ], 'Thematic data deleted succesfull', 500);
        } catch (QueryException $error) {
            return ResponseFormatter::error([
                'message' => 'something went wrong',
                'error' => $error,
            ], 'Thematic Data not deleted', 500);
        }
    }

}
