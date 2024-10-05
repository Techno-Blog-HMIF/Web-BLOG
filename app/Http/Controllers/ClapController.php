<?php

namespace App\Http\Controllers;

use App\Models\Clap;
use Illuminate\Http\Request;

class ClapController extends Controller
{
    //

    public function clap(Request $request)
    {
        $clap = Clap::where('article_id', $request->article_id)
            ->where('user_id', auth('api')->user()->id)
            ->first();

        if ($clap) {
            $clap->clap_count += 1;
            $clap->save();
        } else {
            Clap::create([
                'article_id' => $request->article_id,
                'user_id' => auth('api')->user()->id,
                'clap_count' => 1,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Clap berhasil ditambahkan',
        ]);
    }

    public function unclap(Request $request)
    {
        $clap = Clap::where('article_id', $request->article_id)
            ->where('user_id', auth('api')->user()->id)
            ->first();

        if ($clap) {
            if($clap->clap_count <= 0){
                return response()->json([
                    'success' => false,
                    'message' => 'Clap tidak bisa dikurangi',
                ]);
            }

            $clap->clap_count -= 1;
            $clap->save();

        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Clap gagal dikurangi',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Clap berhasil dikurangi',
        ]);
    }
}
