<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Borrower’s Slip</title>
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

        footer {
            text-align: center;
            align-items: center;
            padding: 5px;
            position: absolute;
            bottom: 0;
            margin-left: 12px;
            margin-right: 12px;
            align-content: center;
            align-self: center;
            left: 0;
            right: 0;
            float: center;
        }
    </style>
</head>


<body>
    <h2 style="text-align: center;"><img src="{{ public_path('uploads/formlogo.png') }}" width="400" height="75">
    </h2>
    <hr />
    <p style="text-align: center; font-size:10px;">349 ORTIGAS Avenue, Brgy. Wack-wack, Mandaluyong City</p>
    <p style="text-align: center; font-size:10px;">TEL No. (02)721-2878/721-2585 Fax No. 411-1820</p>
    <h2 style="text-align: center; "><strong>BORROWER’S SLIP</strong></h2>

    <table style="margin-bottom: 20px; width:100%;">
        <tr style="border-style:hidden;">
            <td
                style="vertical-align: top; border-top-style: hidden; border-left-style: hidden; border-bottom-style: hidden;">
                <div style=" text-align: justify; margin-bottom: 5px;font-size: 13px;"></div>
                <div style=" text-align: justify; margin-bottom: 5px;font-size: 13px;"><b>SITE/EVENT:</b>
                    @foreach ($borrowers as $borrower)
                        {{ $borrower->site }}
                        @php
                            break;
                        @endphp
                    @endforeach
                </div>
                <div style=" text-align: justify;font-size: 13px;"><b>Address:</b>
                    @foreach ($borrowers as $borrower)
                        {{ $borrower->address }}
                        @php
                            break;
                        @endphp
                    @endforeach
                    <div>
            </td>
            <td style="vertical-align: top; border-left-style:hidden;">
                <div style="margin-bottom: 5px;font-size: 13px; text-align:right;"><b>BR No: </b>
                    @foreach ($borrowers as $borrower)
                        {{ $borrower->brnumber }}
                        @php
                            break;
                        @endphp
                    @endforeach
                </div>
                <div style="margin-bottom: 5px;font-size: 13px;text-align:right;"><b>BR Date:</b>
                    @foreach ($borrowers as $borrower)
                        {{ $borrower->checkoutdate }}
                        @php
                            break;
                        @endphp
                    @endforeach
                </div>
                <div style=" font-size: 13px;text-align:right;"><b>Date of Return:</b>
                    @foreach ($borrowers as $borrower)
                        {{ $borrower->dateofreturn }}
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
        @foreach ($borrowers as $borrower)
            @php
                $counter = 1;
            @endphp
            <tr style="text-align: center;">
                <td style="width:40px;">{{ $counter++ }}</td>
                <td style="width:40px;">{{ $borrower->quantity }}</td>
                <td style="width:23px;">{{ $borrower->uom }}</td>
                <td style="word-wrap: break-word;min-width: 100px;max-width: 100px;">
                    {{ $borrower->itemdescription }}</td>
                <td style="word-wrap: break-word;min-width: 60px;max-width: 60px;">{{ $borrower->model }}</td>
                <td style="word-wrap: break-word;min-width: 100px; white-space:pre-wrap; max-width: 100px;">{{ $borrower->serialnumber }}
                </td>
            </tr>
        @endforeach
    </table>
    <p style="text-align: center">===================== NOTHING FOLLOWS ====================</p>

    <footer>
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
</body>


</html>
