<?php

namespace App\Http\Controllers;

use App\Exceldata;
use App\Imports\UsersImport;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\Auth;

class ExcelImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('excel_import.index');
    }
    public function parseImport(Request $request)
    {
      
        $rules = [
            'excle' => 'required', 
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $return = array("status" => 400, "msg" => $validator->errors()->first(), "result" => array());
        } else {
            $data = Excel::toArray(new UsersImport(), $request->file('excle'));
            $countdata = count($data[0]);
            if ($countdata > 0) {
                $csv_data = array_slice($data[0], 0, 5);
                $csv_data_file = Exceldata::create([
                    'user_id' => '1',
                    'excel_filename' => $request->file('excle')->getClientOriginalName(),
                    'excel_data' => json_encode($data)
                ]);
            }
            $return = array('status' => 200, 'data' => view('excel_import.exceldataget', compact('csv_data_file','countdata','csv_data'))->render());
        }
        return \Response::json($return);
    }
     public function processImport(Request $request)
     {
        $data = Exceldata::find($request->csv_data_file_id);
        $csv_data = json_decode($data->excel_data, true);
        if (!empty($csv_data)) {

            foreach ($csv_data[0]  as $key => $row) {
                $user = new User;
                foreach (config('app.db_fields') as $field) {
                    $user->$field = $row[$request->fields[$field]];
                }
                $user->save();
                $arr = array('status' => 200, 'msg' => 'Records added successfully', 'result' => array());

            }
        } else {
            $arr = array('status' => 400, 'msg' => 'not found data', 'result' => array());

        }
        return \Response::json($arr);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
