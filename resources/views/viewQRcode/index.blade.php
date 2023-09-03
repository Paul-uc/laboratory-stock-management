<x-filament::page>
    <style>
        /* Your custom CSS styles go here */
        .container {
            margin-top: 50px;
        }

        .card {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .card-header {
            background-color: #2D4154;
            color: white;
            font-size: 18px;
            font-weight: bold;
            padding: 15px;
            text-align: center;
        }

        .card-body {
            padding: 20px;
            text-align: center; /* Center the QR code horizontally */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 10vh; /* Center vertically within the card */
        }

        .img-fluid {
            max-width: 100%;
        }

        .card-footer {
            text-align: center;
            margin-top: 10px;
            color: #888;
        }
    </style>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        QR Code with Loan ID {{ $record->id }}
                    </div>
                    <div class="card-body">
                        <img {!! QrCode::size(200)->generate($record->id) !!}
                    </div>
                    <div class="card-footer">
                        Scan the QR code for more details.
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament::page>
