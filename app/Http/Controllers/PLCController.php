<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Control;
use Illuminate\Http\JsonResponse;
use App\Models\Data;
use Carbon\Carbon;
use App\Events\NewDataFromPython;

class PLCController extends Controller
{
    public function getDataFromPython(Request $request): JsonResponse
    {
        try {
            $data = $request->all();
            if (!empty($data)) {
                Data::create([
                    'Conveyor_IN' => $data['Conveyor_IN'],
                    'Conveyor_OUT' => $data['Conveyor_OUT'],
                    'CYLINDER_GREEN' => $data['CYLINDER_GREEN'],
                    'CYLINDER_BLUE' => $data['CYLINDER_BLUE'],
                    'CYLINDER_YELLOW' => $data['CYLINDER_YELLOW'],
                    'GREEN_LIGHT' => $data['GREEN_LIGHT'],
                    'YELLOW_LIGHT' => $data['YELLOW_LIGHT'],
                    'RED_LIGHT' =>  $data['RED_LIGHT'],
                    'SIREN' =>  $data['SIREN'],
                    'Setting_Prod_GR_in_box' => $data['Setting_Prod_GR_in_box'],
                    'Setting_Prod_BL_in_box' => $data['Setting_Prod_BL_in_box'],
                    'Setting_Prod_YE_in_box' => $data['Setting_Prod_YE_in_box'],
                    'Setting_Box_GR' => $data['Setting_Box_GR'],
                    'Setting_Box_BL' => $data['Setting_Box_BL'],
                    'Setting_Box_YE' => $data['Setting_Box_YE'],
                    'Prod_GR' => $data['Prod_GR'],
                    'Prod_BL' => $data['Prod_BL'],
                    'Prod_YE' => $data['Prod_YE'],
                    'Box_GR' => $data['Box_GR'],
                    'Box_BL' => $data['Box_BL'],
                    'Box_YE' => $data['Box_YE'],
                    'Prod_GR_in_box' => $data['Prod_GR_in_box'],
                    'Prod_BL_in_box' => $data['Prod_BL_in_box'],
                    'Prod_YE_in_box' => $data['Prod_YE_in_box'],
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
                ]);
            }
            $allData = Data::all() ? Data::all() : "";
            $data['time'] =Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            broadcast(new NewDataFromPython($data, $allData));
            return response()->json([
                'code' => 200,
                'message' => "Thêm dữ liệu thành công",
                'data' => $data
            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['code' => 422, 'message' => 'Invalid data', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['code' => 500, 'message' => 'System error: ' . $e->getMessage()], 500);
        }
    }
    public function sup(Request $request)
    {
        return view("content.sup");
    }
    public function export(Request $request)
    {
        return view("content.export");
    }

    public function getDataFromClient(Request $request): JsonResponse
    {
        try {
            $data = $request->all();
            if (!empty($data)) {
                Control::create([
                    'M_START' => $data['M_START'],
                    'M_STOP' => $data['M_STOP'],
                    'M_MODE' => $data['M_MODE'],
                    'M_RESET' => $data['M_RESET'],
                    'created_at' => Carbon::now()->format('Y-m-d h:m:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d h:m:s')
                ]);
            }
            return response()->json([
                'code' => 200,
                'message' => "Thêm dữ liệu thành công",
                'data' => $data
            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['code' => 422, 'message' => 'Invalid data', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['code' => 500, 'message' => 'System error: ' . $e->getMessage()], 500);
        }
    }
    public function sendDataToClient(Request $request)
    {
        $status = $request->input('status');
        if ($status == "") {
            $data = Data::orderBy('id', 'desc')->first();
            $dataAll = Data::all();
            return response()->json([
                'code' => 200,
                'data' => $data,
                'dataAll' => $dataAll,
            ], 200);
        }
        if ($status == "digital") {
            $data = Data::orderBy('id', 'desc')->first();
            return response()->json([
                'code' => 200,
                'data' => [
                    'Conveyor_IN' => $data['Conveyor_IN'],
                    'Conveyor_OUT' => $data['Conveyor_OUT'],
                    'CYLINDER_GREEN' => $data['CYLINDER_GREEN'],
                    'CYLINDER_BLUE' => $data['CYLINDER_BLUE'],
                    'CYLINDER_YELLOW' => $data['CYLINDER_YELLOW'],
                    'GREEN_LIGHT' => $data['GREEN_LIGHT'],
                    'YELLOW_LIGHT' => $data['YELLOW_LIGHT'],
                    'RED_LIGHT' => $data['RED_LIGHT'],
                    'SIREN' => $data['SIREN'],
                    'Prod_GR' => $data['Prod_GR'],
                    'Prod_BL' => $data['Prod_BL'],
                    'Prod_YE' => $data['Prod_YE'],
                    'Prod_GR_in_box' => $data['Prod_GR_in_box'],
                    'Prod_BL_in_box' => $data['Prod_BL_in_box'],
                    'Prod_YE_in_box' => $data['Prod_YE_in_box'],
                    'time' => $data['created_at'],
                ]
            ], 200);
        }
        if ($status == "filter") {
            $data = Data::all();
            return response()->json([
                'code' => 200,
                'data' => $data,
            ], 200);
        }
    }
}
