<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Approval;
use App\Models\Category;
use App\Models\Stock;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Mail\MailExample;
use App\Mail\SentMail;
use Mail;
use App\Policies\CategoryPolicy;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail as FacadesMail;

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

            $category_id = $approval->stock_id;
            $stock = Stock::find($category_id); // Assuming User model exists with a 'name' attribute
            if ($stock) {
                $formattedOption = "{$stock->category_id} ";
                $category_id = $formattedOption;
            }

            $categoryName = $category_id;
            $category = Category::find($categoryName); // Assuming User model exists with a 'name' attribute
            if ($categoryName) {
                $formattedOption = "{$category->categoryName} ";
                $categoryName = $formattedOption;
            }
           
           
            $id = $approval->id;
            $loan_stock_id = $approval->loan_stock_id;
            $status = $approval->status;
            $statusString = $status ? 'Approved' : 'Not Approved';
            $names = $approval->name;
            $position = $approval->position;
            $remark = $approval->remark;

           
            $id = QrCode::format('png')->size(100)->generate($id);



            $pdf = Pdf::loadView(
                'pdf.index',
                [
                    'id' => $id,
                    'name' => $name,
                    'username' => $username,
                    'category' => $categoryName,
                    'loan_stock_id' => $loan_stock_id,
                    'status' => $statusString,
                    'names' => $names,
                    'position' => $position,
                    'remark' => $remark
                ],
            );
            return $pdf->download('Approval.pdf');
        }
    }

    
    
}
