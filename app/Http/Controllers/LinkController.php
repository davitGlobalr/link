<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->ajax()){
            return response()->json(['success' => false], 500);
        }
        $request->validate([
            'link' => 'required|url'
        ]);

        $input['link'] = $request->link;
        $input['code'] = Str::random(6);

        try {
            Link::create($input);
        } catch (\Exception $e)
        {
            return response()->json(['success' => false], 500);
        }

        $link = $request->link;
        $qrCode = view('qrCode', compact('link'))->render();;
        $input['qrCode'] = $qrCode;

        return response()->json(['data' => $input, 'success' => true], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shortenLink($code)
    {
        $find = Link::where('code', $code)->first();

        return redirect($find->link);
    }
}
