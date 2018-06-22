<?php

namespace App\Http\Controllers\Api;

use App\Models\UnitOfMeasure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnitOfMeasureController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnitOfMeasure  $unitOfMeasure
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnitOfMeasure $unitOfMeasure)
    {
        $unitOfMeasure->delete();

        return response()->json([
            'message' => 'Unit of measure deleted.'
        ]);
    }
    
    /**
     * Restore the specified resource from storage.
     *
     * @param int $unitOfMeasureId
     * @return \Illuminate\Http\Response
     */
    public function restore($unitOfMeasureId)
    {
        UnitOfMeasure::whereId($unitOfMeasureId)->withTrashed()->restore();

        return response()->json([
            'message' => 'Unit of measure restored.'
        ]);
    }
}
