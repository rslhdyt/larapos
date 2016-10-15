<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Sale;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $type)
    {
        $form = $request->all();

        $data = [
            'input' => $form
        ];

        switch ($type) {
            case 'sales':
                $data['sales'] = Sale::search($form)->get();
                break;
            
            default:
                abort(404);
                break;
        }

        return view('reports.' . $type . '.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type, $id)
    {
        $data = [];

        switch ($type) {
            case 'sales':
                $data['sales'] = Sale::find($id);
                break;
            
            default:
                abort(404);
                break;
        }

        return view('reports.' . $type . '.show', $data);
    }

}
