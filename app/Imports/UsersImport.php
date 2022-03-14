<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class UsersImport implements
    ToCollection,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    SkipsOnFailure,
    WithChunkReading,
    ShouldQueue,
    WithEvents
{
    use Importable,
        SkipsErrors,
        SkipsFailures,
        RegistersEventListeners;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
            $user=User::create([
                'name' => $row['name'],
                'email'=> $row['email'],
                'password'=> Hash::make('password')
            ]);
            $user->address()->create([
                'country' => $row['country']
            ]);
        }
    }

//    public function onError(Throwable $e)
//    {
//        // TODO: Implement onError() method.
//    }
    public function rules(): array
    {
        return[
            '*.email'=>['email', 'unique:users,email']
        ];
    }

//    public function onFailure(Failure ...$failures)
//    {
//        return back()->withFailures($failures);
//    }


    public function chunkSize(): int
    {
        return 1000;
    }

    public static function afterImport(AfterImport $event)
    {
        // TODO: Implement registerEvents() method.
    }
}
