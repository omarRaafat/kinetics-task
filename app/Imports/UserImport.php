<?php

namespace App\Imports;

use App\User;
use App\Uuid;
use Maatwebsite\Excel\Concerns\ToModel;

class UserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

            return new User([
                'first_name' => $row[0],
                'last_name' => $row[1],
                'family_name' => $row[2],
                'uuid' => $row[3]
            ]);




    }
}
