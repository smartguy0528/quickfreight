<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        .main {
            background-color: rgb(167, 192, 222);
        }

        tr {
            margin-top: 50px;
        }

        .txt-container div {
            margin-left: 50px;
            text-align: center;
            margin-top: 5px;
            text-align: center;
            flex: 1;
            display: flex;
        }

        .text-container {
            padding-right: 100px;
        }
        .float-left {
            float: left;
        }
        .clearfix {
            clear: both;
        }
        .c-row>div {
            float: left;
            margin-top: 10px;
        }
        .c-row>div:first-child {
            width: 200px;
        }
        .c-row>div:nth-child(2) {
            width: 300px;
        }
        .border-1-right {
            text-align: right;
        }
        .c-tr {
            margin: 0;
        }
        .c-tr div:nth-child(1) {
            width: 60%;
            float: left;
            border-right: none !important;
            padding-right: 20px;
        }
        .c-tr div:nth-child(2) {
            width: 40%;
            float: left;
            padding-right: 20px;
        }
        .border-1 {
            border: 1px solid gray;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
</head>
<body>
    <div style="margin-top: 100px;padding: 0 20px;">
        <div>
            <img src="{{ asset('assets/common/img/logo/loder.png') }}" alt="jobclass" style="height: 40px;">
            <div class="main inline-block float-right" style="font-size:25px;font-weight:700;height:70px;padding:10px;">Quick Freight Enterprise INC.</div>
            <div class="clearfix"></div>
        </div>

        <div class="position-relative mt-5" style="padding: 50px;">
            <div class="position-absolute" style="left: 0;font-weight: 500;">
                <p>Order ID: {{ $quoteReq->id_alias }}</p>
                <p>Your order from [date]: {{ $quoteApp->created_at }}</p>
                <p>User Address: {{ $quoteApp->company_address }}</p>
            </div>
            <div class="position-absolute text-right" style="right: 0;font-weight: 500;">
                <p>Name: {{ $customer->first_name }} {{ $customer->last_name }}</p>
                <p>Email: {{ $customer->email }}</p>
                <p>Phone: {{ $customer->phone }}</p>
            </div>
        </div>
        <div class="text-center w-100" style="margin-top: 150px;">
            <div class="c-tr">
                <div class="main border-1">Description</div>
                <div class="main border-1">Amount</div>
            </div>
            <div class="clearfix"></div>
            <div class="c-tr">
                <div class="border-1">
                    {{ $quoteReq->commodity }} Transport</div>
                <div class="border-1"> $ {{ $quoteApp->total_cost }}</div>
            </div>
            <div class="clearfix"></div>
            <div class="c-tr">
                <div class="border-1-right">Amount</div>
                <div class="border-1"> $ {{ $quoteApp->cost }}</div>
            </div>
            <div class="clearfix"></div>
            <div class="c-tr">
                <div class="border-1-right">Fee</div>
                <div class="border-1"> $ {{ $quoteApp->fee }}</div>
            </div>
            @if($quoteApp->cost + $quoteApp->fee - $quoteApp->total_cost > 0)
            <div class="clearfix"></div>
            <div class="c-tr">
                <div class="border-1-right">Disaccount</div>
                <div class="border-1"> - $ {{ $quoteApp->cost + $quoteApp->fee - $quoteApp->total_cost }}</div>
            </div>
            @endif
            <div class="clearfix"></div>
            <div class="c-tr">
                <div class="border-1-right"><b>Total</b></div>
                <div class="border-1"><b> $ {{ $quoteApp->total_cost }}</b></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <h6 style="margin-top: 80px;">The payment was paid via @if($quoteReq->payment_status == 1) Paypal @else Stripe @endif</h6>
        <h6> Transaction ID: {{ $quoteReq->transaction_id }}</h6>
        <h6 class="mt-5 text-center">Invoice from <a href="<?php echo url('');?>">Quick Freight Enterprise INC</a></h6>
    </div>
</body>
</html>
