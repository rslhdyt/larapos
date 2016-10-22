<?php

namespace App\Http\Controllers;

use App\Role;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $data = [
            'user'  => Auth::user(),
            'roles' => Role::dropdown(),
        ];

        return view('settings.users.profile', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $form = $request->all();

        $user = Auth::user();
        $user->update($form);

        return redirect('settings/profile')
            ->with('message-success', 'Profile updated!');
    }
}
