<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LeadsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $leads;

    // Constructor to accept dynamic data
    public function __construct($leads)
    {
        $this->leads = $leads;
    }

    // Convert data to a collection
    public function collection()
    {
        return collect($this->leads);
    }

    // Define the headings for the CSV file
    public function headings(): array
    {
        return [
            'ID',
            'User Name',
            'Email',
            'Mobile Number',
            'Location',
            'Area Type',
            'Preferred Location',
            'From Date',
            'To Date',
            'Budget',
            'Follow-up Date',
            'Plan Date',
            'Lead Status',
            ' Status',
            'Description',
            'Created At',
            'Updated At'
        ];
    }

    // Map data to the correct format
    public function map($lead): array
    {
        return [
            $lead->id,
            $lead->user_name,
            $lead->email ?? 'N/A',
            $lead->mobile_no,
            $lead->location,
            $lead->area_type,
            $lead->preferd_location ?? 'N/A',
            $lead->from_date,
            $lead->too_date ?? 'N/A',
            $lead->budget,
            $lead->followup_date ?? 'N/A',
            $lead->plan_date ?? 'N/A',
            $this->getLoanStatus($lead->loan_status), // Convert loan status to text
            $lead->lead_status,
            $lead->message,
            $lead->created_at,
            $lead->updated_at
        ];
    }

    // Helper function to map loan status
    private function getLoanStatus($status)
    {
        $statuses = [
            1 => "Initial Stage",
            2 => "Team Call",
            3 => "Call Disconnected",
            4 => "Ringing",
            5 => "Pipeline",
            6 => "Visit Align",
            7 => "Conversion",
            8 => "Rejected",
            9 => "Assign Lead",
            10 => "Visit Done",
            11 => "Breaking Period",
            12 => "Ask To Callback",
            13 => "Preferred Location"
        ];

        return $statuses[$status] ?? "Unknown";
    }
}
