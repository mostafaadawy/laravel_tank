<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class UsersImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
//        return new User([
//            'name' => $row[0],
//            'email'=> $row[1],
//            'password'=> Hash::make('password')
//        ]);
        return new User([
            'name' => $row['name'],
            'email'=> $row['email'],
            'password'=> Hash::make('password')
        ]);
    }

    public function onError(Throwable $e)
    {
        // TODO: Implement onError() method.
    }
}
