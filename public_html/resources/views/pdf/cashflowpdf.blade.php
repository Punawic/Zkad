<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }

        body {
            font-family: "THSarabunNew";
        }
        table{
            border-collapse: collapse ; 
        }
        th{
            border: 1px solid ; 
        }

        /* td{
            border: 1px solid ; 
        } */

        .head {
            font-size: 24px ; 
        }

        span {
            font-size: 24px ; 
        }

        .noraml {
            font-size: 20px ; 
        }

        .page-break {
            page-break-after: always;
        }

    </style>

</head>
<body>

     <?php

        function bahtText(float $amount): string
        {
            [$integer, $fraction] = explode('.', number_format(abs($amount), 2, '.', ''));

            $baht = convert($integer);
            $satang = convert($fraction);

            $output = $amount < 0 ? 'ลบ' : '';
            $output .= $baht ? $baht.'บาท' : '';
            $output .= $satang ? $satang.'สตางค์' : 'ถ้วน';

            return $baht.$satang === '' ? 'ศูนย์บาทถ้วน' : $output;
        }

        function convert(string $number): string
        {
            $values = ['', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า'];
            $places = ['', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน'];
            $exceptions = ['หนึ่งสิบ' => 'สิบ', 'สองสิบ' => 'ยี่สิบ', 'สิบหนึ่ง' => 'สิบเอ็ด'];

            $output = '';

            foreach (str_split(strrev($number)) as $place => $value) {
                if ($place % 6 === 0 && $place > 0) {
                    $output = $places[6].$output;
                }

                if ($value !== '0') {
                    $output = $values[$value].$places[$place % 6].$output;
                }
            }

            foreach ($exceptions as $search => $replace) {
                $output = str_replace($search, $replace, $output);
            }

            return $output;
        }
    ?>

    @for ($i = 0; $i < sizeof($header); $i++)


        <div align="center">
            <span class="head"><b>ใบเสร็จรับเงิน / ใบส่งของ</b></span><br>
            <span class="head"><b>INVOICE / DELIVERY </b></span>
        </div>
        <div align='left'>
        <span>ต้นฉบับ / Original</span> 
        </div>

        <div>
            <div style="float:left">
                <table  width="50%">
                    <tr>
                        <td> <b> เลขประจำตัวผู้เสียภาษี </b> </td>
                        <td> <b> : {{ $header[$i][0]->tax }} </b></td>
                    </tr>

                    <tr>
                        <td> <b>  ชื่อลูกค้า </b> </td>
                        <td> <b>  : {{ $header[$i][0]->name }}</b>   </td>
                    </tr>
                    
                    <tr>
                        <td> <b> ที่อยู่</td>
                        <td> <b>  : {{ $header[$i][0]->addr }}</b>  </td>
                    </tr>
                </table>
            </div>

            <div style="float:right">
                <table  width="30%">
                    <tr>
                        <td> <b>เลขที่</b> </td>
                        <td><b> : {{ $header[$i][0]->invoice_id }}</b> </td>
                    </tr>
                    <tr>
                        <td><b>วันที่</b></td>
                        <td><b> : {{ $header[$i][0]->created_at }}</b></td>
                    </tr>
                    <tr>
                        <td><b>ชำระเงิน</b></td>
                        <td><b> : Credit</b></td>
                    </tr>
                    <tr>
                        <td><b>พนักงานขาย</b></td>
                        <td><b> : {{ $header[$i][0]->salesname }}</b></td>
                    </tr>
                </table>
            </div>
        </div>



        <div style=" clear: both;">
            <br>
            <table width="100%">
                <tr>
                    <th align="center" >ลำดับ <br> NO</th>
                    <th align="center">รายการสินค้า <br> ITEM</th>
<th align="center">SKU</th>
                    <th align="center">จำนวน <br> QTY</th>
<th align="center">ต้นทุน/ชิ้น <br> COST/PCS</th>
                    <th align="center">ราคาขาย/ชิ้น <br> PRICE/PCS</th>
 <th align="center">ต้นทุนรวม<br> AMOUNT </br> BAHT</th>
                    <th align="center">จำนวนเงิน <br> AMOUNT </br> BAHT</th>
                </tr>

                <?php $sum = 0 ?>

                @for ($j = 0; $j < sizeof($array[$i]); $j++)
                <?
                  $purchase_price =$array[$i][$j]->buy;
                  $sale_price =$array[$i][$j]->cost;

                  $avgPrice = avgPrice($array[$i][$j]->product_id);
                  $purchase_price =$avgPrice->cost;
                  $sale_price =$avgPrice->buy;
?>
                    <tr>
                        <th align="center"> {{$j+1}} </th>
                        <th align="center"> {{ $array[$i][$j]->name }} </th>
   <th align="center"> {{ $array[$i][$j]->barcode_id }} </th>
                        <th align="center"> {{ number_format ( $array[$i][$j]->qty ) }} </th>
  <th align="center"> {{ number_format ( $sale_price ) }} </th>
                        <th align="center">  {{  number_format( $purchase_price ) }} </th>
                        <th align="center"> {{ number_format ( $sale_price * $array[$i][$j]->qty ) }} </th>

                        <th align="center"> {{ number_format ( $purchase_price * $array[$i][$j]->qty ) }} </th>
                        {{ $sum += $sale_price * $array[$i][$j]->qty  }}  </br>



                    </tr>
                @endfor



              

                <tr>
                    <td  colspan="3" align="center" > <b> ( {{bahtText($sum)}} ) </b> </td>
                    <td align="center">  <b> ต้นทุนรวมทั้งสิ้น  </b> </td>
                    <td align="center"> <b> {{ number_format ( $sum ) }}  </b> </td>
                </tr> <br>




              
            </table>
            </div>
            
            <div style=" clear: both;">
                <table width="100%">
                    <tr>
                        <td align="center" colspan="1"> 
                            <div style="clear:both">
                                ได้ตรวจสอบสินค้าตามรายการดังกล่าวเรียบร้อยแล้ว <br>
                                <div style="float:left;padding-left:30px;padding-right:30px">
                                        _______________ <br> 
                                        ผู้รับสินค้า <br>
                                        ....../....../......
                                </div>
                                <div style="float:left;padding-left:30px;padding-right:30px">
                                    _______________ <br> 
                                    ผู้รับสินค้า <br>
                                    ....../....../......
                                </div>
                                <div style="float:left;padding-left:30px;padding-right:30px">
                                    _______________ <br> 
                                    ผู้รับสินค้า <br>
                                    ....../....../......
                                </div>
                            </div>
                        </td>
                        <td align="center" colspan="1"></td>
                        <td align="center" colspan="1"></td>
                    </tr>
                </table>
            </div>

            @if ($i == sizeof($header)-1)

            @else
                <div class="page-break"></div>
            @endif

    @endfor

</body>
</html>