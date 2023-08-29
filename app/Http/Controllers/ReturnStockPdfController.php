<?php

namespace App\Http\Controllers;

use App\Models\returnStock;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


use App\Models\Category;
use App\Models\Stock;
use App\Models\User;

class ReturnStockPdfController extends Controller
{
    public function download($id)
    {
        $approval = returnStock::find($id);

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
           
           

            $loan_stock_id = $approval->id;
            $status = $approval->status;
            $statusString = $status ? 'Approved' : 'Not Approved';
            $names = $approval->name;
            $position = $approval->position;
            $remark = $approval->remark;




            $pdf = Pdf::loadView(
                'pdf.index',
                [
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
