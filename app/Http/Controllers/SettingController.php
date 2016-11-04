<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
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
            'settings' => Setting::all(),
        ];

        return view('settings.general.edit', $data);
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
        $form = $request->except('_method', '_token');
        $form = collect($form);

        $form->each(function ($value, $key) {
            $setting = Setting::where(['key' => $key])->first();
            $setting->value = $value;
            $setting->save();
        });

        return redirect('settings/general')
            ->with('message-success', 'Setting updated!');
    }
}
