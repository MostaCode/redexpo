<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ClientsImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function  __construct($id)
    {
        $this->agent_id = $id;
    }

    public function collection(Collection $rows)
    {
       foreach($rows as $row) {
        Client::create([
            'agent_id'=>$this->agent_id,
            'phone'=>$row['phone']
        ]);
        }

    }
}
