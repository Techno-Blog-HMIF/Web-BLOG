<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function followUser(Request $request)
    {
        $followerId = $request->followed_id;
        $followedId = auth('api')->user()->id;

        if ($followerId == $followedId) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak bisa follow diri sendiri',
            ]);
        }

        // Periksa apakah pengguna sudah mem-follow
        $follow = Follow::where('follower_id', $followerId)
            ->where('followed_id', $followedId)
            ->first();

        if ($follow) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah follow user ini',
            ]);
        }

        // Buat entri follow baru
        Follow::create([
            'followed_id' => $followedId,
            'follower_id' => $followerId,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil follow user',
        ]);
    }

    public function unfollowUser(Request $request)
    {
        $followerId = $request->followed_id;
        $followedId = auth('api')->user()->id;

        if ($followerId == $followedId) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak bisa unfollow diri sendiri',
            ]);
        }

        // Periksa apakah pengguna sudah mem-follow
        $follow = Follow::where('follower_id', $followerId)
            ->where('followed_id', $followedId)
            ->first();

        if (!$follow) {
            return response()->json([
                'success' => false,
                'message' => 'Anda belum follow user ini',
            ]);
        }

        // Hapus entri follow
        $follow->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil unfollow user',
        ]);
    }
}
