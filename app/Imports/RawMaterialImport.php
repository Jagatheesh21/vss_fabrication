<?php

namespace App\Imports;
use App\Models\Category;
use App\Models\Type;
use App\Models\RawMaterial;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RawMaterialImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $category = Category::where('name','like',"%".$row['category']."%")->first();
        $type = Type::where('name','like',"%".$row['type']."%")->first();
        return new RawMaterial([
            'category_id' => $category->name,
            'type_id' => $type->name,
            'name' => $row['name'],
            'part_description' => $row['part_description'],

        ]);
    }
}
