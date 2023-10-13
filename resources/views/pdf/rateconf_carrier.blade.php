<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rate Confirmation {{$quoteReq->id_alias}}</title>
    <style>
        body {
            margin: 0 auto;
            width: 700px;
            font-size: 14px;
        }
        p {
            margin: 0;
        }
        .v-top {
            vertical-align: top;
        }
        .border-1 {
            border-bottom: 1px solid #000000;
        }
        .border-2 {
            border-bottom: 4px double #000000;
        }
        .border-1r {
            border-right: 1px solid #000000;
        }
        .text-right {
            text-align: right;
        }

    </style>
</head>
<body>
    <table style="width: 100%">
        <tr>
            <td style="width: 14%"></td>
            <td style="width: 14%"></td>
            <td style="width: 14%"></td>
            <td style="width: 14%"></td>
            <td style="width: 14%"></td>
            <td style="width: 14%"></td>
            <td style="width: 16%"></td>
        </tr>
        <tr>
            <td colspan="2" class="border-2 v-top"><p>Quick Freight INC</p></td>
            <td colspan="4" class="border-2"><h1>Rate Confirmation</h1></td>
            <td colspan="1" class="border-2 v-top">
                <p>{{$quoteReq->id_alias}}</p>
                <p>{{explode(' ', $quoteComp->created_at)[0]}}</p>
                <p>{{explode(' ', $quoteComp->created_at)[1]}}</p>
            </td>
        <tr>
        <tr>
            <td colspan="5" class="border-1 v-top"><h2>Quick Freight INC</h2></td>
            <td colspan="2" class="border-1">
                <p>FROM: QUICK FRIGHT ENTERPRISE INC</p>
                <p>(912) 233-2935</p>
                <p>(912) 233-9925 FAX</p>
            </td>
        <tr>
        <tr>
            <td colspan="1"><p>TO</p></td>
            <td colspan="3"><p>: {{$carrier->legal_name}}</p></td>
            <td colspan="1"><p>TRUCK #</p></td>
            <td colspan="2"><p>: {{$driver->truck_num}}</p></td>
        <tr>
        <tr>
            <td colspan="1" class="border-1"><p>ATT</p></td>
            <td colspan="3" class="border-1"><p>: FERNANDO</p></td>
            <td colspan="1"><p>DRIVER</p></td>
            <td colspan="2"><p>: {{$driver->name}}</p></td>
        <tr>
        <tr>
            <td colspan="2"><p>PICKUP</p></td>
            <td colspan="2"><p>: {{$quoteReq->pickup}}</p></td>
            <td colspan="1"><p>DRIVER CELL</p></td>
            <td colspan="2"><p>: {{$driver->phone}}</p></td>
        <tr>
        <tr>
            <td colspan="2" class="border-1"><p>PICKUP DATE/TIME</p></td>
            <td colspan="2" class="border-1"><p>: {{$quoteReq->pickupDate}}@</p></td>
            <td><p>TYPE</p></td>
            <td colspan="2"><p>: {{$driver->truck_type}}</p></td>
        <tr>
        <tr>
            <td colspan="2"><p>FINAL DESTINATION</p></td>
            <td colspan="2"><p>: {{$quoteReq->delivery}}</p></td>
            <td><p>WEIGHT</p></td>
            <td colspan="2"><p>: {{$driver->truck_capacity}}</p></td>
        <tr>
        <tr>
            <td colspan="2"><p>DEL APPT DATE/TIME</p></td>
            <td colspan="2"><p>: {{$quoteReq->deliveryDate}}@</p></td>
            <td><p>MILES</p></td>
            <td colspan="2"><p>: {{$driver->miles}}</p></td>
        <tr>
        <tr>
            <td colspan="2" class="border-1"><p></p></td>
            <td colspan="2" class="border-1"><p></p></td>
            <td class="border-1"><p>DESCRIPTION</p></td>
            <td colspan="2" class="border-1"><p>: {{$quoteComp->carrier_comment}}</p></td>
        <tr>

        <tr>
            <td colspan="5" class="border-1"></td>
            <td colspan="2" class="border-1">[Dispach Notes]</td>
        <tr>

        <tr>
            <td><p>TOTAL RATE</p></td>
            <td colspan="2" class="border-1r"><p>$ {{$quoteComp->deliver_cost}}</p></td>
            <td><p>COMPANY</p></td>
            <td colspan="3"><p>: {{$quoteApp->company_name}}, {{$quoteReq->company_address}}</p></td>
        <tr>
        <tr>
            <td colspan="3" class="border-1r"></td>
            <td colspan="1"><p>COMMODITY</p></td>
            <td colspan="3"><p>: {{$quoteReq->commodity}}, {{$quoteReq->dimension}}, {{$quoteReq->weight}}</p></td>
        <tr>
        <tr>
            <td colspan="3" class="border-1r"></td>
            <td colspan="1"><p>TEMPERATURE</p></td>
            <td colspan="3"><p>: {{$quoteReq->temperature}}</p></td>
        <tr>
        <tr>
            <td colspan="3" class="border-1 border-1r"></td>
            <td colspan="1" class="border-1"><p>COMMENT</p></td>
            <td colspan="3" class="border-1"><p>: {{$quoteComp->company_carrier_comment}}</p></td>
        <tr>

        <tr>
            <td colspan="7" class="border-1">
                <p>* Terms are Net 30 from postmark or date emailed to billing@tototaltransport.us</p>
                <ul>
                    <li>DRIVER NAME <b>{{$driver->name}}</b> *REQUIRED</li>
                    <li>DRIVER PHONE NUMBER <b>{{$driver->phone}}</b> *REQUIRED</p>
                    <li><b>{{$carrier->legal_name}}</b> INITIAL DRIVER IS FAMILIAR WITH CONSTRUCTION EQUIPMENT AND MAY BE REQUIRED TO LOAD AND UNLOAD THEMSELVES.</li>
                    <li><b>{{$carrier->legal_name}}</b> INITIAL DRIVER MUST MEASURE AND SAFELY SECURE LOAD TO ENSURE LEGAL DIMENSIONS BEFORE LEAVING PICKUP LOCATION.</li>
                    <li><b>{{$carrier->legal_name}}</b> INITIAL OUR LOAD WILL BE DRIVEN ONTO AND OFF OF THE TRAILER.</p>
                </ul>
                <p>SO, NOTHING CAN BE BLOCKING OUR LOAD AT PICKUP OR DELIVERY. IF DRIVER ARRIVES AT PICKUP OR DELIVERY WITH SOMETHING BLOCKING OUR LOAD, THE DRIVER WILL BE 100% RESPONSIBLE FOR ARRANGEMENT AND COST TO MOVE THAT ITEM.</p>
            </td>
        <tr>

        <tr>
            <td class="text-right" colspan="3">
                <h3>Company Sign: {{$quoteComp->company_sign}}</h3>
            </td>
            <td class="text-right" colspan="3">
                <h3>Carrier Sign: {{$quoteComp->carrier_sign}}</h3>
            </td>
        </tr>

    </table>
</body>
</html>
