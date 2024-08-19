<?php

namespace App\Exports;

use App\Models\User\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::where('user_type','partner')->get();
    }
}
