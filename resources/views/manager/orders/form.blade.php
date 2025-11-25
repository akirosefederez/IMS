<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delivery Receipt</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        th,
        td,
        table {
            border-color: black;
            border-style: solid;
            border-collapse: collapse;
            font-size: 12px;
        }

        #doc {
            font-family: Arial, Helvetica, sans-serif;
            width: 100%;
            font-size: 10px;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        #doc th,
        td {
            padding-top: 5px;
            padding-bottom: 5px;
            font-size: 12px;
        }

        #tablefooter table {
            border-collapse: separate;
        }

        #footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 7.5rem;
            /* Footer height */
        }
    </style>
</head>

<body>
    <div style="page-break-after: always">
        <h2 style="text-align: center;"><img src="{{ public_path('uploads/formlogo.png') }}" width="400" height="75">
        </h2>
        <hr />
        <p style="text-align: center; font-size:10px;">349 ORTIGAS Avenue, Brgy. Wack-wack, Mandaluyong City</p>
        <p style="text-align: center; font-size:10px;">TEL No. (02)721-2878/721-2585 Fax No. 411-1820</p>
        <h2 style="text-align: center; ">DELIVERY RECEIPT</h2>
        <table style="margin-bottom: 20px; width:100%;">
            <tr style="border-style:hidden;">
                <td
                    style="vertical-align: top; border-top-style: hidden; border-left-style: hidden; border-bottom-style: hidden;">
                    <div style=" text-align: justify; margin-bottom: 5px;font-size: 13px;"><b>SR No:</b>
                        @foreach ($order_items as $order_item)
                            {{ $order_item->srnumber }}
                            @php
                                break;
                            @endphp
                        @endforeach
                    </div>
                    <div style=" text-align: justify; margin-bottom: 5px;font-size: 13px;"><b>SITE/EVENT:</b>
                        @foreach ($order_items as $order_item)
                            {{ $order_item->site }}
                            @php
                                break;
                            @endphp
                        @endforeach
                    </div>
                    <div style=" text-align: justify;font-size: 13px;"><b>Address:</b>
                        @foreach ($order_items as $order_item)
                            {{ $order_item->address }}
                            @php
                                break;
                            @endphp
                        @endforeach
                        <div>
                </td>
                <td style="vertical-align: top; border-left-style:hidden;">
                    <div style="margin-bottom: 5px;font-size: 13px; text-align:right;"><b>DR No: </b>{{ $drnumber }}
                    </div>
                    <div style="margin-bottom: 5px;font-size: 13px;text-align:right;"><b>PO No:</b>
                        @foreach ($order_items as $order_item)
                            {{ $order_item->ponumber }}
                            @php
                                break;
                            @endphp
                        @endforeach
                    </div>
                    <div style=" font-size: 13px;text-align:right;"><b>Date:</b>
                        @foreach ($order_items as $order_item)
                            {{ $order_item->checkoutdate }}
                            @php
                                break;
                            @endphp
                        @endforeach
                    </div>
                </td>
            </tr>
        </table>
        <table id="doc" border="1">
            <tr>
                <th style="text-align: center;">ITEM NO.</th>
                <th style="text-align: center;">QTY</th>
                <th style="text-align: center;">UOM</th>
                <th style="text-align: center;">DESCRIPTION</th>
                <th style="text-align: center;">MODEL</th>
                <th style="text-align: center;">SERIAL NO.</th>
            </tr>
            @php
                $counter = 1;
            @endphp
            @foreach ($order_items as $order_item)
                <tr style="text-align: center">
                    <td style="width:40px;">{{ $counter++ }}</td>
                    <td style="width:40px;">{{ $order_item->quantity }}</td>
                    <td style="width:23px;">{{ $order_item->uom }}</td>
                    <td style="word-wrap: break-word;min-width: 100px;max-width: 100px;">
                        {{ $order_item->itemdescription }}</td>
                    <td style="word-wrap: break-word;min-width: 60px;max-width: 60px;">{{ $order_item->model }}</td>
                    <td style="word-wrap: break-word;min-width: 100px; white-space:pre-wrap; max-width: 100px;">
                        {{ $order_item->serialnumber }}</td>
                </tr>
            @endforeach
        </table>
        <p style="text-align: center">===================== NOTHING FOLLOWS ====================</p>

        <footer style="margin-top:10px;">
            {{-- <p><span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;">&nbsp;&nbsp;Prepared
                        by:&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checked by:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Released
                        by:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Returned by:&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;Received by:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Approved
                        by:&nbsp;&nbsp;</span></span></p>
            <p style="text-align: center;">&nbsp;&nbsp; __________&nbsp;&nbsp;&nbsp; __________&nbsp;&nbsp;&nbsp;&nbsp;
                __________&nbsp;&nbsp;&nbsp; __________&nbsp;&nbsp;&nbsp; __________&nbsp;
                &nbsp;&nbsp;__________&nbsp;&nbsp;</p> --}}
            <table style="width:100%; text-align:center;">
                <tr style="">
                    <td style="padding-top:15px;padding-bottom:15px; border-right-style:hidden;">Prepared by:
                        <br><br><br>_______________
                    </td>
                    <td style="padding-top:15px;padding-bottom:15px; border-right-style:hidden;">Checked by:
                        <br><br><br>_______________
                    </td>
                    <td style="padding-top:15px;padding-bottom:15px; border-right-style:hidden;">Released by:
                        <br><br><br>_______________
                    </td>
                    <td style="padding-top:15px;padding-bottom:15px; border-right-style:hidden;">Returned by:
                        <br><br><br>_______________
                    </td>
                    <td style="padding-top:15px;padding-bottom:15px; border-right-style:hidden;">Received by:
                        <br><br><br>_______________
                    </td>
                    <td>Approved by: <br><br><br>_______________</td>
                </tr>
            </table>
            <p style="text-align: right; font-size:10px;">GENERATED BY: {{ Auth::user()->name }}</p>
        </footer>
    </div>

    {{-- 2ND PAGE DR Client Copy --}}
    <table style="border-collapse: collapse; width: 100%; height: 192px; margin-bottom:20px;">
        <tbody>
            <tr style="height: 156px;">
                <td
                    style="width: 60%; vertical-align: top; border-top-style: hidden; border-left-style: hidden; border-bottom-style: hidden; margin-right:5px;">
                    <p style="text-align: center;"><img style="display: block; margin-left: auto; margin-right: auto;"
                            src="{{ public_path('uploads/formlogo.png') }}" alt="" width="360"
                            height="65" /></p>
                    <div style="text-align: center; font-size:11px;">349 ORTIGAS Avenue, Brgy. Wack-wack, Mandaluyong
                        City</div>
                    <div style="text-align: center;font-size:11px;">TEL No. (02)721-2878/721-2585 Fax No. 411-1820</div>
                    <div style=" text-align: justify;">&nbsp;</div>
                    <div style=" text-align: justify; margin-bottom: 5px;font-size: 13px;"><b>Client:</b>
                        @foreach ($order_items as $order_item)
                            {{ $order_item->client }}
                            @php
                                break;
                            @endphp
                        @endforeach
                    </div>
                    <div style=" text-align: justify; margin-bottom: 5px;font-size: 13px;"><b>Address:</b>
                        @foreach ($order_items as $order_item)
                            {{ $order_item->address }}
                            @php
                                break;
                            @endphp
                        @endforeach
                    </div>
                    <div style=" text-align: justify;font-size: 13px;"><b>Contact Person:</b>
                        @foreach ($order_items as $order_item)
                            {{ $order_item->contact }}
                            @php
                                break;
                            @endphp
                        @endforeach
                    </div>
                </td>
                <td style="vertical-align:top;">
                    <h1 style="text-align: center;">DELIVERY RECEIPT</h1>
                    <p style="text-align: center;font-size:20px;font-family:'Times New Roman', Times, serif;"><b>No.</b>&nbsp;{{ $drnumber }}</p>
                    <table style="width:95%;border-top:none;border-left:none;border-right:none;border-bottom:none;" border="1">
                        <tbody>
                            <tr>
                                <td style="width:20%;text-align:right;border:none;padding-bottom:0%;">
                                        <b>Date:</b>
                                </td>
                                <td style="text-align:center;border-top:none;border-right:none;border-left:none;padding-bottom:0%;">
                                    @foreach ($order_items as $order_item)
                                    {{ $order_item->checkoutdate }}
                                    @php
                                        break;
                                    @endphp
                                @endforeach
                                </td>
                            </tr>

                            <tr>
                                <td style="width:20%;text-align:right;border:none;padding-bottom:0%;">
                                        <b>Terms:</b>
                                </td>
                                <td style="border-top:none;border-right:none;border-left:none;padding-bottom:0%;"></td>
                            </tr>

                            <tr>
                                <td style="width:20%;text-align:right;border:none;padding-bottom:0%;">
                                    <b>PO No:</b>
                                </td>
                                <td style="text-align:center;border-top:none;border-right:none;border-left:none;padding-bottom:0%;">
                                    @foreach ($order_items as $order_item)
                                    {{ $order_item->ponumber }}
                                    @php
                                        break;
                                    @endphp
                                @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; height:36px; border-style:solid" id="doc" border="1">
        <tbody>
            <tr style="height: 18px;">
                <th style="text-align: center;">ITEM NO.</th>
                <th style="text-align: center;">QTY</th>
                <th style="text-align: center;">UOM</th>
                <th style="text-align: center;">DESCRIPTION</th>
                <th style="text-align: center;">MODEL</th>
                <th style="text-align: center;">SERIAL NO.</th>
            </tr>
            @php
            $counter = 1;
        @endphp
        @foreach ($order_items as $order_item)
            <tr style="text-align: center">
                <td style="width:40px;">{{ $counter++ }}</td>
                <td style="width:40px;">{{ $order_item->quantity }}</td>
                <td style="width:23px;">{{ $order_item->uom }}</td>
                <td style="word-wrap: break-word;min-width: 100px;max-width: 100px;">
                    {{ $order_item->itemdescription }}</td>
                <td style="word-wrap: break-word;min-width: 60px;max-width: 60px;">
                    {{ $order_item->model }}
                </td>
                <td
                    style="word-wrap: break-word; white-space: pre-wrap; min-width: 100px;max-width: 100px;">{{ $order_item->serialnumber }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6">
                <p style="text-align: center">===================== NOTHING FOLLOWS ====================</p>
            </td>
        </tr>
        </tbody>
    </table>

    <footer id="footer" style="margin-top:10px; height:200px; margin-top: 100px;">
        <table style="width:100%; text-align:center;">
            <tr>
                <td style="vertical-align:top; text-align:left; width:60%;">&nbsp;&nbsp;&nbsp;&nbsp;SPECIAL
                    INSTRUCTIONS/REMARKS: </td>
                <td style="text-align:center; width:40%;" rowspan="2">Received the above descriptions in
                    good
                    order
                    and condition. <br><br><br>_________________________________<br>SIGNATURE OVER PRINTED
                    NAME<br><br>_________________________________<br>DATE</td>
            </tr>
            <tr style="vertical-align:top; text-align:justified;">
                <td style="width:60%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Prepared
                    by:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checked
                    by:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Released
                    by:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Approved by:</td>
            </tr>
        </table>
        <p style="text-align: right; font-size:10px;">GENERATED BY: {{ Auth::user()->name }}</p>
    </footer>
</body>

</html>
