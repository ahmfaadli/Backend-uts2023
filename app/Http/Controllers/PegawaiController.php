<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    //
    public function index()
    {
        //Menggunakan model Pegawai untuk select data
        $pegawais = Pegawai::all();
        
        //jika data kosong maka kirim status code 204
        if($pegawais->isEmpty()){
            $data = [
                'message' => 'Gat All Pegawai'
        ];
        //menembalikan data dalam bentuk json
            return response()->json($data, 200);
     }

        $data = [
            'message' => 'Data Is Empty',
            'data' => $pegawais
        ];

        //Mengembalikan data dalam bentuk json
        return response()->json($data, 200);
    
    }

    public function store(Request $request)
    {
        // Validasi data request
        $request->validate([
            'name' => "required",
            'gender' => "required",
            'phone' => "required|numeric",
            'address' => "required",
            'email' => "required|email",
            'status' => "required",
            'hired_on' => "required|date",
        ]);

       $input = [
            'name' => $request->name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'status' => $request->status,
            'hired_on' => $request->hired_on,
       ];

        $pegawai = Pegawai::create($input);

        $data = [
            'message' => 'Pegawai is added succesfully',
            'data' => $pegawai
        ];
        
        return response()->json($data, 201);
    }

    public function show ($id)
    {
    $pegawai = Pegawai::find($id);

    if (!pegawai){
        $data = [

            "message" => " Data not found"
        ];
        

        return response()->json($data, 404);
    }

    $data - [
        "message" => "Show detail pegawai",
        "data" => $pegawai
    ];

    return response()->json($data, 200);
    }

    public function update(Request $request , $id)
    {
        //
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            $data = [
                "messaga" => 'Data not found'
            ];

            return response()->json($data, 404);
        }

        $pegawai->update([
            'name' => $request->nama ?? $pegawai->name,
            'gender' => $request->gender ?? $pegawai->gender,
            'phone' => $request->phone ?? $pegawai->phone,
            'address' => $request->address ?? $pegawai->address,
            'email' => $request->email ?? $pegawai->email,
            'status' => $request->status ?? $pegawai->status,
            'hired_on' => $request->hired_on ?? $pegawai->hired_on,
       ]);

        $data = [
            'message' => 'Student is updated succesfully',
            'data' => $pegawai
        ];
            return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);

        // jika data kosong
        if(!$pegawai){
            $data = [
                'message' => 'Pegawai not found'
            ];

            return response()->json($data, 404);
        }

        $pegawai->delete();

        $data = [
            'message' => 'Pegawai is deleted succesfully',
            'data' => $pegawai,
        ];

            return response()->json($response, 200);
        }

        public function search(string $name)
        {
            $pegawai = Pegawai::where('name', 'like', "%{$name}%")->get();

            //jika data kosong
            if(!$pegawai){
                $data = [
                    'message' => 'Resource not found',
                ];
                return response()->json($data, 404);
    
            } else {
                
                $data = [
                    'message' => 'Get search resource',
                    'data' => $pegawai
                ];

                return response()->json($data, 200);
            }
        }

        public function active(){
            $pegawai = Pegawai::where('status', 'active')->get();

            //mengaktifkan jumlah resource aktif
            $total = Pegawai::where('status', 'active')->count();

            $data = [
                'messsage' => 'Get Active Resource',
                'total' => $total,
                'data' => $pegawai,
            ];

            return response()->json($data, 200);
        }

        public function inactive(){
            $pegawai = Pegawai::where('status', 'inactive')->get();

            //mengaktifkan jumlah resource aktif
            $total = Pegawai::where('status', 'inactive')->count();

            $data = [
                'messsage' => 'Get inactive Resource',
                'total' => $total,
                'data' => $pegawai,
            ];

            return response()->json($data, 200);
        }

        public function terminated(){
            $pegawai = Pegawai::where('status', 'terminated')->get();

            //mengaktifkan jumlah resource aktif
            $total = Pegawai::where('status', 'terminated')->count();

            $data = [
                'messsage' => 'Get Active Resource',
                'total' => $total,
                'data' => $pegawai,
            ];

            return response()->json($data, 200);
        }
}
