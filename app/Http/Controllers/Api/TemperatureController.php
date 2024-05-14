<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Temperature;
use Illuminate\Http\Request;

class TemperatureController extends Controller
{
    function getTemperature(){
        $temperature = Temperature::all();
        //Mengambil semua data temperature kemudian disimpan ke variabel data
        
        return response()->json([
            "message" => "Data temperature berhasil diambil",
            "data"    => $temperature
        ], 200);
        //Mengembalikan response dalam format json dengan format data berupa "message" juga berupa "data" dan status code 200
    }

    function insertTemperature(Request $request){
        $value = $request->temperature;
        //Mengambil data request

        $temperature = Temperature::create([
            "value" => $value
        ]);
        //Menyimpan data ke database

        return response()->json([
            "message" => "Data temperature berhasil ditambahkan",
            "data"    => $temperature
        ], 201);
        //Mengembalikan response json dengan status code 201
    }

    function updateTemperature(Request $request, $id){
        $validatedData = $request->validate([
            'value' => 'required|numeric',
        ]);
        // Validasi input
        
        $temperature = Temperature::findOrFail($id);
        // Temukan data temperatur berdasarkan ID
        
        $temperature->value = $validatedData['value'];
        // Tambahkan nilai temperatur ke kolom value
        
        $temperature->save();
        // Simpan perubahan

        return response()->json([
            "message" => "Data temperature berhasil diubah",
            "data"    => $temperature
        ], 201);
        //Mengembalikan response json dengan status code 201
    }

    function deleteTemperature($id){
            $temperature = Temperature::find($id);
            // Temukan data temperatur berdasarkan ID

            $temperature->delete();
            // Hapus data temperature
            
            return response()->json([
                "message" => "Data temperature berhasil dihapus",
                "data"    => $temperature
            ], 201);
            //Mengembalikan response json dengan status code 201
    }
}
