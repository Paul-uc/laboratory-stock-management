<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\lossStock;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LossStockPdfController extends Controller
{
    public function download($id)
    {
        $lossStockModel = lossStock::find($id);

        if ($lossStockModel) {
            // Assign fetched data to variables
            $username = $lossStockModel->userId;
            if ($username) {
                $user = User::find($username); // Assuming User model exists with a 'username' attribute

              
                if ($username) {
                    $formattedOption = "{$user->username} ";
                    $username = $formattedOption;
                }
            }
            $name = $lossStockModel->userId;

            $user = User::find($name); // Assuming User model exists with a 'name' attribute
            if ($name) {
                $formattedOption = "{$user->name} ";
                $name = $formattedOption;
            }

            $category_id = $lossStockModel->stock_id;
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
           
           

            $loan_stock_id = $lossStockModel->loan_stock_id;
            $status = $lossStockModel->status;
            $statusString = $status ? 'Paid' : 'Pending for payment';
            $names = $lossStockModel->name;
            $position = $lossStockModel->position;
            $remark = $lossStockModel->remark;




            $pdf = Pdf::loadView(
                'pdf.loss',
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
            return $pdf->download('lossStock.pdf');
        }
    }
}
