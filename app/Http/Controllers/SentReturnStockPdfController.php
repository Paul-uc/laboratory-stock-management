<?php

namespace App\Http\Controllers;

use App\Mail\MailExample;
use App\Models\Category;
use App\Models\returnStock;
use App\Models\Stock;
use App\Models\User;
use PDF;
use Mail;
use Illuminate\Http\Request;

class SentReturnStockPdfController extends Controller
{
   public function index($id)
    {
        $approval = returnStock::find($id);

        if ($approval) {
            //Assign fetched data to variables
            $username = $approval->userId;

            if ($username) {
                $user = User::find($username); // Assuming User model exists with a 'username' attribute

                if ($user) {
                    $formattedOption = "{$user->username}";
                    $username = $formattedOption;
                }
            }
            $name = $approval->userId;

            $user = User::find($name); // Assuming User model exists with a 'name' attribute
            if ($user) {
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





            $loan_stock_id = $approval->loan_stock_id;
            $status = $approval->status;
            $statusString = $status ? 'Approved' : 'Not Approved';
            $names = $approval->name;
            $position = $approval->position;
            $remark = $approval->remark;

            $data = [
                'title' => 'TARUMT Return Stock Summary Report',
                'name' => $name,
                'username' => $username,
                'category' => $categoryName,
                'loan_stock_id' => $loan_stock_id,
                'status' => $statusString,

                'names' => $names,
                'position' => $position,
                'remark' => $remark
            ];

            $pdf = PDF::loadView('pdf.return', $data);
            $data["pdf"] = $pdf;

            Mail::to(["your@gmail.com"])->send(new MailExample($data));


            return redirect();
        }
    }
}
