<!doctype html>
<html lang="en">

<head>
    <title>{{__($stock[0]['customer_id'])}} Ledger Invoice</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        /* .page {
            width: 29.7cm;
            min-height: 21cm;
            padding: 2cm;
            margin: 1cm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        } */
        hr{border-top: 1px solid black;}

        @page {
            width: 100mm;
            margin: 0;
        }

        @media print {
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }

        @media print {
            tr.vendorListHeading {
                background-color: #1a4567 !important;
                -webkit-print-color-adjust: exact;
            }
        }

        @media print {
            .vendorListHeading th {
                color: white !important;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="card-toolbar " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover"
            title="" data-bs-original-title="Click to genrate report">

        </div>
        <div class="page-inner">
            <p class="text-center  mb-0 text-uppercase"><b>{{ __('OASIS AGRI') }}</b></p>
            <p class="text-center  mb-0">{{ __('INDUSTRIAL AREA BLOCK "E" R.Y.K') }}</p>
            <p class="text-center  mb-0">{{ __('SORAKHI, TEHSIL DADYAL, DISTRICT MIRPUR') }}</p>
            <p class="text-center  mb-0">{{ __('0345-6433332 , 0303-6136037') }}</p>
            <p class="text-center  font-weight-bold mb-0 text-uppercase text-decoration-underline"><u> {{ __('Customer Ledger Invoice') }}</u></p>

            <div class="row px-4" >
                    <div class="col-6 text-left mt-1">
                        <p><b>Invoice # :</b>{{__('10000008')}}</p>
                    </div>
                    <div class="col-6 text-right mt-1 ">
                        <p class="  mb-0 "><b>Date:</b>
                            {{ date('d-M-y h:i:s A') }}
                        </p>
                    </div>
                    <div class="col-12 text-left mt-1">
                        <p ><b>Customer Name:</b> {{__($stock[0]['customer_id'])}}
                        </p>
                    </div>
                    <div class="col-12 text-left mt-1">
                        <p ><b>Father Name:</b> {{__($data['customer']['father_name'])}}
                        </p>
                    </div>
                    <div class="col-12 text-left mt-1">
                        {{-- @dd($data['customer']) --}}
                        <p ><b>NIC No.:</b>{{__($data['customer']['CNIC'])}}
                            {{-- {{__($stock[0]['customer_id'])}} --}}
                        </p>
                    </div>
                    <div class="col-12 text-left mt-1">
                        <p ><b>Address: </b>{{__($data['customer']['adress'])}}
                            {{-- {{__($stock[0]['customer_id'])}} --}}
                        </p>
                    </div>
                    <div class="col-4 text-left mt-1">
                        <p ><b>Franchise Name:</b>{{__($stock[0]['customer_id'])}}
                        </p>
                    </div>
                    <div class="col-4 text-left mt-1">
                        <p ><b>Territory:</b>{{__($stock[0]['customer_id'])}}
                        </p>
                    </div>
                </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        {{-- table-bordered --}}
                        <table id="table" class="table table-striped table-hover  table-bordered display"
                            width="100%">
                            <thead class="border-top">
                                <tr id="table-1" style="background-color: #b5b5b5  !important;">
                                    {{-- <th width="115px">ID#</th> --}}
                                    <th>{{ __('Product Name') }}</th>
                                    <th>{{ __('Policy') }}</th>
                                    <th>{{ __('Quantity') }}</th>
                                    <th>{{ __('Rate') }}</th>
                                    <th>{{ __('Gross Amount') }}</th>
                                    {{-- <th>{{ __('Return Date') }}</th>
                                    <th>{{ __('Return Product Quantity') }}</th>
                                    <th>{{ __('Total Quantity') }}</th>
                                    <th>{{ __('Policy Discount') }}</th>
                                    <th>{{ __('Credit Note') }}</th> --}}
                                    {{-- <th width="12%">{{ __('Total Bill') }}</th> --}}
                                    {{-- <th>{{ __('Advance Amount') }}</th>
                                    <th>{{ __('Remaning Amount') }}</th> --}}
                                    {{-- <th width="115px">{{ __('Status') }}</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $q=0;
                                    $t=0;
                                    $index=0;
                                @endphp
                                @foreach ($stock as $key=>$value)
                                    <tr class="border">
                                        <td>{{ $value['product_id'] }}</td>
                                        <td>{{ $value['policy_name'] }}</td>
                                        <td>{{ $value['product_quantity'] }}</td>
                                        <td>{{ number_format($value['product_seal_price']) }}</td>
                                        {{-- <td>{{ $value['created_at'] }}</td>
                                        <td>{{ $value['return_date'] }}</td>
                                        <td>{{ $value['return_product_quantity'] }}</td>
                                        <td>{{ $value['total_quantity'] }}</td>
                                        <td>{{ $value['policy_discount'] }}</td>
                                        <td>{{ $value['credit_note'] }}</td> --}}
                                        @php
                                            $q+=$value['total_quantity'];
                                            $t+= $value['bill'];
                                            $index=$key;
                                        @endphp
                                        <td>{{ number_format($value['bill'] )}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                   <hr class="col-12" style="margin-top: 10vh">
                    <p class="col-3"><b>Total :</b></p>
                    <p class="col-5 text-center">{{__($q)}}</p>
                    <p class="col-3 text-center"> {{__(number_format($stock[$index]['totalamount']))}}</p>
                    <hr class="col-12">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12" >
                        <p >
                            <b class="h4" style="
                            font-family: serif;
                        ">??????: ???????? ???? ???????????? ?????? ???? ???? ???? ???????? ???????????????? ???? ???????? ?????? ?????? ?????? ???? ?????? ?????? ???????? ???????? ?????????? ?????? ?????????? ???? ???? ???????? ?????? ?????? ???? ?????????? ???????? ?????? ?????????? ?????????? ???????????? 7 ???? ???? ???????? ???????? ?????????? ???? ???? ???? ?????? ?????????? ???????? ???????? ???????? ???????????? ???????? ?????? ???????????? ?????????? ???????????? ???? ?????????? 15 ???? ???? ???????? ???????? ?????????? ???? ?????? ???? ???? ?????? ?????????? ???????????? ???????? ???????? ???? ???? ?????? ???????? ???? ???? ?????? ???? ?????????????? ???? ???????? ???????????? ???? ??????????</b>
                        </p>
                    </div>
                    <hr class="col-12" style="margin-bottom: 4vh">
                    <p class="col-12 text-left"><b>Total Amount: </b>{{__(number_format($stock[$index]['totalamount']))}}</p>
                    <p class="col-12 text-left"><b>Deposited: </b>{{__(number_format($stock[$index]['advance_amount']))}}</p>
                    <p class="col-12 text-left" style="margin-bottom: 10vh"><b>Remaining: </b>{{__(number_format($stock[$index]['totalamount']-$stock[$index]['advance_amount']))}}</p>

                    <div class="col-3 text-center">
                        <hr>
                        Prepared By
                    </div>
                    <div class="col-3 text-center" style=" margin-left: 8vh;">
                        <hr>
                        Approved By
                    </div>
                    <div class="col-3 text-center" style="margin-left: 8vh;">
                        <hr>
                        Dealer's Signature & Stamp
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            window.print();
            // setTimeout(function() {
            //     window.location.href = "{{ route('admin.customer_lager_invoice.index') }}"
            // }, 1000);
        });
    </script>
</body>

</html>
