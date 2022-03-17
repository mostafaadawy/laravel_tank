<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;


class ProductsImport implements
    ToModel,
    WithChunkReading,
    SkipsOnError,
    WithValidation
{
    use Importable,
        SkipsErrors;


    public function chunkSize(): int
    {
        return 1000;
    }


    public function model(array $row)
    {
        return new Product([
            'lineItemId' => $row[0],
            'final_price' => $row[11],
            'old_price' => $row[10],
            'available' => 1,
        ]);
    }

    public function rules(): array
    {
        return[
            '*.0'=>['required', 'unique:products,lineItemId']
        ];
    }
}
