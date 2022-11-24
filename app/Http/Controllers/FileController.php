<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function batchFilesDelete(Request $request)
    {
        try {

            // dd(($request->all())['files']);
            $files= ($request->all())['files'];
            foreach ($files as $file) {
                try {
                    unlink($file);
                } catch (\Throwable $th) {
                }
            }

            $response = ["status" => "Success"];
            return response(json_encode($response, JSON_NUMERIC_CHECK), 200, ["Content-Type" => "application/json"]);
        } catch (\Throwable $th) {
            $response = ["status" => "Failure" ];
            return response(json_encode($response, JSON_NUMERIC_CHECK), 400, ["Content-Type" => "application/json"]);
        }
       
    }

}