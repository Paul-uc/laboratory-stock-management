<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Approval;
use App\Models\User;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Illuminate\Http\Request;

class DownloadPdfController extends Controller
{
    public function download($id)
    {
        $approval = Approval::find($id);

        if ($approval) {
            // Assign fetched data to variables
            $username = $approval->userId;
            if ($username) {
                $user = User::find($username); // Assuming User model exists with a 'username' attribute
                if ($username) {
                    $formattedOption = "{$user->username} ";
                    $username = $formattedOption;
                }
            }
            $name = $approval->userId;

            $user = User::find($name); // Assuming User model exists with a 'name' attribute
            if ($name) {
                $formattedOption = "{$user->name} ";
                $name = $formattedOption;
            }

            $stock_id = $approval->stock_id;
            $loan_stock_id = $approval->loan_stock_id;
            $status = $approval->status;
            $names = $approval->name;
            $position = $approval->position;
            $remark = $approval->remark;




            $pdf = Pdf::loadView(
                'pdf.index',
                [
                    'name' => $name,
                    'userId' => $username,
                    'stock_id' => $stock_id,
                    'loan_stock_id' => $loan_stock_id,
                    'status' => $status,
                    'names' => $names,
                    'position' => $position,
                    'remark' => $remark
                ],
            );
            return $pdf->download('invoice.pdf');
        }
    }
}
