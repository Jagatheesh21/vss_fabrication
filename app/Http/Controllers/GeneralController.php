<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Type;
use App\Models\RawMaterial;
use App\Models\ChildPartNumber;
use App\Models\PartMaster;
use App\Models\ChildPartBom;
use App\Models\Uom;
use App\Models\OperationType;
use App\Models\Operation;
use App\Models\Nesting;
use App\Models\NestingSequence;
use App\Models\StoreTranscation;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function __construct()
    {

    }

    public function getTypes()
    {
        $types = Type::whereStatus(1)->get();
        
    }
    public function getMaterials(Request $request)
    {
        $materials = RawMaterial::whereStatus(1);
        if($request->type_id)
        {
            $type_id = $request->type_id;
            $materials->where('type_id',$type_id);
        }
        $materials = $materials->get();
        $html = view('general.raw_materials',compact('materials'))->render();
        return response(['html' => $html]);
    }

}
