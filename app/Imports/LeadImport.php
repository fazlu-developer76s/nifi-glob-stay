<?php

namespace App\Imports;

use App\Models\Enquiry;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LeadImport implements ToModel, WithHeadingRow
{
    protected $insertCount = 0;
    protected $duplicateCount = 0;

    /**
     * Process each row and check for duplicates.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $existingUser = DB::table('enquiries')->where('mobile_no', $row['number'])->first();

        if ($existingUser) {
            // Increment duplicate count if mobile number already exists
            $this->duplicateCount++;
            return null;
        }

        // Insert the data using DB::table()
        DB::table('enquiries')->insert([
            'name' => $row['name'],
            'email' => $row['mail_id'],
            'mobile_no' => $row['number'],
            'date' => $row['date'],
            'location' => $row['current_location'],
            'preferd_location' => $row['preferred_location'],
        ]);

        $this->insertCount++;

        return null;
    }


    /**
     * Get the count of inserted records.
     *
     * @return int
     */
    public function getInsertCount()
    {
        return $this->insertCount;
    }

    /**
     * Get the count of duplicate records.
     *
     * @return int
     */
    public function getDuplicateCount()
    {
        return $this->duplicateCount;
    }
}

