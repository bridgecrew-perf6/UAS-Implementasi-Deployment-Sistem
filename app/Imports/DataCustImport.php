<?php

namespace App\Imports;

use App\Models\DataCust;
use Maatwebsite\Excel\Concerns\ToModel;

class DataCustImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DataCust([
                'nama'=> $row[1],
                'alamat' => $row[2],
                'id_kelurahan' => $row[3]
            
        ]);
    }
}
