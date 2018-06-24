<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted.'
        ]);
    }
    
    /**
     * Restore the specified resource from storage.
     *
     * @param int $userId
     * @return \Illuminate\Http\Response
     */
    public function restore($userId)
    {
        User::whereId($userId)->withTrashed()->restore();

        return response()->json([
            'message' => 'User restored.'
        ]);
    }
}
