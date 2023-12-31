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
        $returnStockModel = returnStock::find($id);

        if ($returnStockModel) {
            // Assign fetched data to variables
            $username = $returnStockModel->userId;
            if ($username) {
                $user = User::find($username); // Assuming User model exists with a 'username' attribute
                if ($username) {
                    $formattedOption = "{$user->username} ";
                    $username = $formattedOption;
                }
            }
            $name = $returnStockModel->userId;

            $user = User::find($name); // Assuming User model exists with a 'name' attribute
            if ($name) {
                $formattedOption = "{$user->name} ";
                $name = $formattedOption;
            }

            $category_id = $returnStockModel->stock_id;
            $stock = Stock::find($category_id); // Assuming Stock model exists with a 'category_id' attribute
            if ($stock) {
                $formattedOption = "{$stock->category_id} ";
                $category_id = $formattedOption;
            }

            $categoryName = $category_id;
            $category = Category::find($categoryName); // Assuming Category model exists with a 'categoryName' attribute
            if ($categoryName) {
                $formattedOption = "{$category->categoryName} ";
                $categoryName = $formattedOption;
            }
        
            $loan_stock_id = $returnStockModel->id;
            $status = $returnStockModel->status;
            $statusString = $status ? 'Returned' : 'Not Returned';
            $names = $returnStockModel->name;
            $position = $returnStockModel->position;
            $remark = $returnStockModel->remark;
            $penalty = $returnStockModel->penalty;

            $pdf = Pdf::loadView(
                'pdf.return',
                [
                    'title' => 'TARUMT Return Stock Summary Report',
                    'name' => $name,
                    'username' => $username,
                    'category' => $categoryName,
                    'loan_stock_id' => $loan_stock_id,
                    'status' => $statusString,
                    'names' => $names,
                    'position' => $position,
                    'remark' => $remark,
                    'penalty' => $penalty
                ],
            );
            return $pdf->download('ReturnStock.pdf');
        }
    }
}
