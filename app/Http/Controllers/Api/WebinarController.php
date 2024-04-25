<?php

namespace App\Http\Controllers\Api;

use App\Models\Webinar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\WebinarResource;
use App\Http\Requests\Api\WebinarRequest;

class WebinarController extends Controller
{
    public function index() {
        $webinar = Webinar::latest()->get();

        return new WebinarResource(true, 'List Webinar', $webinar);
    }

    public function store(WebinarRequest $request) {
        if ($request->discount >= 1) {
            $temp_discount_price = ($request->price * $request->discount) / 100;
            $discount_price = $request->price - $temp_discount_price;

            $createData = Webinar::create([
                'title' => $request->title,
                'date' => $request->date,
                'time' => $request->time,
                'via' => $request->via,
                'base_price' => $request->price,
                'discount' => $request->discount,
                'price' => $discount_price,
            ]);

            return new WebinarResource(true, 'Add data webinar', $createData);
        } else {
            $createData = Webinar::create([
                'title' => $request->title,
                'date' => $request->date,
                'time' => $request->time,
                'via' => $request->via,
                'base_price' => $request->price,
                'discount' => $request->discount,
                'price' => $request->price,
            ]);

            return new WebinarResource(true, 'Add data webinar', $createData);
        }
    }

    public function show(Webinar $dataWebinar) {
        return new WebinarResource(true, 'Data Webinar', $dataWebinar);
    }

    public function update(WebinarRequest $request, Webinar $dataWebinar) {
        if ($request->discount >= 1) {
            $temp_discount_price = ($request->price * $request->discount) / 100;
            $discount_price = $request->price - $temp_discount_price;

            $dataWebinar->update([
                'title' => $request->title,
                'date' => $request->date,
                'time' => $request->time,
                'via' => $request->via,
                'base_price' => $request->price,
                'discount' => $request->discount,
                'price' => $discount_price,
            ]);

            return new WebinarResource(true, 'Update data webinar', $dataWebinar);
        } else {
            $dataWebinar->update([
                'title' => $request->title,
                'date' => $request->date,
                'time' => $request->time,
                'via' => $request->via,
                'base_price' => $request->price,
                'discount' => $request->discount,
                'price' => $request->price,
            ]);

            return new WebinarResource(true, 'Update data webinar', $dataWebinar);
        }
    }

    public function destroy(Webinar $dataWebinar, Request $request) {
        // return response()->json($request);
        $tokenPass = Hash::make($request->token);
        if (Hash::check('awaludapi', $tokenPass)) {
            $dataWebinar->delete();
            return new WebinarResource(true, 'Data webinar terhapus', null);
        } else {
            return response()->json('Not Authorized', 401);
        }
    }
}
