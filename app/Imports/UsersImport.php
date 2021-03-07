<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements WithStartRow, WithHeadingRow
{
     /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
