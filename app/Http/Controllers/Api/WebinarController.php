<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\WebinarRequest;
use App\Http\Resources\WebinarResource;
use App\Models\Webinar;
use Illuminate\Http\Request;

class WebinarController extends Controller
{
    public function index() {
        $webinar = Webinar::latest()->get();

        return new WebinarResource(true, 'List Webinar', $webinar);
    }

    public function store(WebinarRequest $request) {
        if ($request->discount >= 1) {
            $discount_price = ($request->price * $request->discount) / 100;

            $createData = Webinar::create([
                'title' => $request->title,
                'date' => $request->date,
                'time' => $request->time,
                'via' => $request->via,
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
                'discount' => $request->discount,
                'price' => $request->price,
            ]);

            return new WebinarResource(true, 'Add data webinar', $createData);
        }
    }

    public function show(Webinar $dataWebinar) {
        return new WebinarResource(true, 'Data Webinar', $dataWebinar);
    }
}
