<!doctype html>
<html lang="en">

<head>
    @php
    $customer=get_customer($recorde->customer_id)->customer_name;
    $product=get_product($recorde->data[0]['product_id']);
    @endphp
    <title>{{get_customer($recorde->customer_id)->customer_name}} | Ledger Invoice</title>
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
                        <p ><b>Customer Name:</b> {{__(get_customer($recorde->customer_id)->customer_name)}}
                        </p>
                    </div>
                    <div class="col-12 text-left mt-1">
                        <p ><b>Father Name:</b> {{__(get_customer($recorde->customer_id)->father_name)}}
                        </p>
                    </div>
                    <div class="col-12 text-left mt-1">
                        {{-- @dd($data['customer']) --}}
                        <p ><b>NIC No.:</b>{{__(get_customer($recorde->customer_id)['CNIC'])}}
                            {{-- {{__($stock[0]['customer_id'])}} --}}
                        </p>
                    </div>
                    <div class="col-12 text-left mt-1">
                        <p ><b>Address: </b>{{__(get_customer($recorde->customer_id)['adress'])}}
                            {{-- {{__($stock[0]['customer_id'])}} --}}
                        </p>
                    </div>
                    <div class="col-4 text-left mt-1">
                        <p ><b>Franchise Name:</b>{{__($recorde->customer_id)}}
                        </p>
                    </div>
                    <div class="col-4 text-left mt-1">
                        <p ><b>Territory:</b>{{__($recorde->customer_id)}}
                        </p>
                    </div>
                    <div class="col-4 text-left mt-1">
                        <p ><b>Policy:</b>{{__($recorde->policy_name)}}
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
                                    <th>{{ __('Product Name') }}</th>
                                    <th>{{ __('Quantity') }}</th>
                                    <th>{{ __('Rate') }}</th>
                                    <th>{{ __('Gross Amount') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $q=0;
                                    $t=0;
                                    $index=0;
                                    $total=0;
                                @endphp
                                {{-- @dd($recorde->data) --}}
                                @foreach ($recorde->data as $key=>$value)
                                    <tr class="border">
                                        <td>{{ $value['product_id'] }}</td>
                                        <td>{{ $value['product_quantity'] }}</td>
                                        <td>{{ number_format($value['product_Sale_price']) }}</td>
                                        @php
                                            $q+=$value['product_quantity'];
                                            $t+= $value['product_quantity']*$value['product_Sale_price'];
                                            $index=$key;
                                            $total=$t;
                                        @endphp
                                        <td>{{ number_format($value['product_Sale_price']*$value['product_quantity'])}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                   <hr class="col-12" style="margin-top: 10vh">
                    <p class="col-3"><b>Total :</b></p>
                    <p class="col-5 text-center">{{__($q)}}</p>
                    <p class="col-3 text-center"> {{__(number_format($total))}}</p>
                    <hr class="col-12">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12" >
                        <p >
                            <b class="h4" style="
                            font-family: serif;
                        ">نوٹ: ڈیلر کا انوائس اور پی آر کے بغیر نومائندے کے ساتھ کسی بھی قسم کا لین دین ذاتی تصور ہوگا۔ اور کمپنی اس کی ہرگز ذمہ دار نہ ہوگی۔ رساؤ اور نقصان پہنچا پراڈکٹ 7 دن کے اندر قابل واپسی ہے اس کے بعد کمپنی کوئی کلیم نہیں کرےگی۔ کوئی بھی پراڈکٹ کمپنی پالیسی کے مطابق 15 دن کے اندر قابل واپسی ہے اور اس کے بعد کمپنی پراڈکٹ واپس نہیں لے گی اور ڈیلر کو اس رقم کی ادائیگی پر کوئی اعتراض نہ ہوگا۔</b>
                        </p>
                    </div>
                    <hr class="col-12" style="margin-bottom: 4vh">
                    <p class="col-12 text-left"><b>Total Amount: </b>{{__(number_format($total))}}</p>
                    {{-- <p class="col-12 text-left"><b>Total Amount: </b>{{__(number_format($stock[$index]['totalamount']))}}</p> --}}
                    <p class="col-12 text-left"><b>Deposited: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{__(number_format($recorde['recive_amount']))}}</p>
                    <p class="col-12 text-left" style="margin-bottom: 10vh"><b>Remaining: </b>&nbsp;&nbsp;&nbsp;{{__(number_format($total-$recorde['recive_amount']))}}</p>

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
            setTimeout(function() {
                window.location.href = "{{ route('admin.sale.index') }}"
            }, 1000);
        });
    </script>
</body>

</html>
