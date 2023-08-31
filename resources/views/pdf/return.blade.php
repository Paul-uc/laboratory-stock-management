<!DOCTYPE html>
<html>
<header>
    <style>
        table.sheet0 {
            font-size: 14px;
            font-weight: bolder;
            table-layout: fixed;
            width: 100%;
        }

        table.sheet0 th,
        table.sheet0 td {
            text-align: left;
            border: none;
            padding: 5px 0 5px 0;
        }

        table.sheet0 tr {
            background-color: white;
        }

        table.sheet0 tr:nth-child(odd) {
            background-color: #F3F3F3;
        }

        table.sheet0 th {
            font-size: 15px;
            font-weight: bold;
            color: white;
            background-color: #2D4154;
        }
    </style>
</header>
<div class="container mt-5 mb-5">

    <div class="row d-flex justify-content-center">

        <div class="col-md-8">

            <div class="card">




                <div class="invoice p-5">

                    <h5>Summary Return Report is Stated as below!</h5>


                    <span class="font-weight-bold d-block mt-4"></span>
                    <span>You Returned is being review and received!</span>

                    <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">

                        <table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0">
                            <thead>
                                <tr class="row0">
                                <th> <span class="d-block text-muted">Loan Stock Id</span> </th>
                                    <th> <span class="d-block text-muted">Name:</span> </th>
                                    <th> <span class="d-block text-muted">ID Number: </span> </th>
                                    <th> <span class="d-block text-muted">Status</span> </th>
                                    <th> <span class="d-block text-muted">Stock Category</span> </th>
                                 
                                    <th> <span class="d-block text-muted">Approval By</span> </th>
                                    <th> <span class="d-block text-muted">Approval Position</span> </th>
                                    <th> <span class="d-block text-muted">Remarks</span> </th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr class="row1">
                                <td> <span>{{$loan_stock_id}}</span> </td>
                                    <td> <span>{{$name}}</span> </td>
                                    <td> <span>{{$username}}</span> </td>
                                    <td> <span>{{$status}}</span> </td>
                                    <td> <span>{{$category}}</span> </td>
                                    
                                    <td> <span>{{$names}}</span> </td>
                                    <td> <span>{{$position}}</span> </td>
                                    <td> <span>{{$remark}}</span> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p>Thank you for choosing TARUMT Laboratory System, see you again!</p>
                    <p class="font-weight-bold mb-0">Thanks for collaboration!</p>
                    <span>TARUMT Team</span>
                </div>
            </div>
        </div>
    </div>
</div>

</html>