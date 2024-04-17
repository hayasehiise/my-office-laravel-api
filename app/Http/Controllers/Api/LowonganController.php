<?php

namespace App\Http\Controllers\Api;

use App\Models\Lowongan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\LowonganResource;
use App\Http\Requests\Api\LowonganRequest;
use Illuminate\Validation\ValidationException;

class LowonganController extends Controller
{
    public function index() {
        $lowongan = Lowongan::latest()->paginate(10);

        return new LowonganResource(true, 'list data lowongan', $lowongan);
    }

    public function store(LowonganRequest $request) {
        $createData = Lowongan::create([
            'title' => $request->title,
            'location' => $request->location,
            'category' => $request->category,
            'desc' => $request->desc,
        ]);

        return new LowonganResource(true, 'Data lowongan terinput', $createData);
    }

    public function show(Lowongan $dataLowongan) {
        return response()->json($dataLowongan);
    }

    public function update(LowonganRequest $request, Lowongan $dataLowongan) {
        $dataLowongan->update([
            'title' => $request->title,
            'location' => $request->location,
            'category' => $request->category,
            'desc' => $request->desc,
        ]);

        return new LowonganResource(true, 'Data lowongan terupdate', $dataLowongan);
    }

    public function destroy(Lowongan $dataLowongan, Request $request) {
        // return response()->json($request);
        $tokenPass = Hash::make($request->token);
        if (Hash::check('awaludapi', $tokenPass)) {
            $dataLowongan->delete();
            return new LowonganResource(true, 'Data lowongan terhapus', null);
        } else {
            return response()->json('Not Authorized', 401);
        }
    }


}
