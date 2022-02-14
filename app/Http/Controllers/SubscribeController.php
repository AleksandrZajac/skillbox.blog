<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscribeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSubscribe()
    {
        $subscribe = DB::table('subscribe_user')
            ->select('subscribe_id')
            ->where('user_id', auth()->user()->id)->first();

        if ($subscribe == null) {
            $subscribe = false;
        } else {
            $subscribe = true;
        }

        return $subscribe;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toggleSubscribe(Request $request)
    {
        if (empty($request->subscribe_id && !empty($request->user_id))) {
            DB::table('subscribe_user')
                ->where('user_id', $request->user_id)->delete();
        } else {
            DB::table('subscribe_user')->insert([
                'subscribe_id' => $request->subscribe_id,
                'user_id' => $request->user_id,
            ]);

            return (['message' => 'task was successful']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        return view('subscribes.show');
    }
}
