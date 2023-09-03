<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Request Confirmation</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .invoice {
            padding: 30px;
        }

        .header {
            background-color: #2D4154;
            color: white;
            font-size: 18px;
            font-weight: bold;
            padding: 15px;
            text-align: center;
        }

        .content {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #2D4154;
            color: white;
        }

        .qr-code {
            text-align: center;
            margin-top: 20px;
        }

        .qr-code img {
            max-width: 200px;
        }

        .message {
            margin-top: 20px;
        }

        .footer {
            background-color: #2D4154;
            color: white;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="header">
            Loan Request Confirmation
        </div>
        <div class="content">
            <h2>Your Loan Request Has Been Processed!</h2>
            <p>We are pleased to inform you that your Loan Request has been successfully processed and is currently under review.</p>
            <table>
                <tr>
                    <th>Loan Stock Id</th>
                    <td>{{$loan_stock_id}}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{$name}}</td>
                </tr>
                <tr>
                    <th>ID Number</th>
                    <td>{{$username}}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{$status}}</td>
                </tr>
                <tr>
                    <th>Stock Category</th>
                    <td>{{$category}}</td>
                </tr>
                <tr>
                    <th>Approval By</th>
                    <td>{{$names}}</td>
                </tr>
                <tr>
                    <th>Approval Position</th>
                    <td>{{$position}}</td>
                </tr>
                <tr>
                    <th>Remarks</th>
                    <td>{{$remark}}</td>
                </tr>
            </table>
            <div class="qr-code">
                <img src="data:image/png;base64,{{ base64_encode($id) }}" alt="QR Code">
                <p>Scan the QR code at the Laboratory to collect your loaned item.</p>
            </div>
        </div>
        <div class="message">
            <p>Please proceed to the Lab to collect your loaned item once your request is approved. If your request is rejected, you can resubmit it for further consideration.</p>
            <p class="font-weight-bold">Thank you for your collaboration!</p>
           
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} TARUMT. All rights reserved.
        </div>
    </div>
</div>
</body>
</html>
