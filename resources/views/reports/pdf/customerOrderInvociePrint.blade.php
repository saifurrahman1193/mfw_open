<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Invoice</title>
<style type="text/css" media="screen">

body{
  font-size: 10pt;
  line-height: 14px;
  /* padding-top: -40px; */
  /* margin-top: -50px; */
}

table {
  border-collapse: collapse;
}
    p.header-title{
        font-size: 10pt;
        line-height: 5px;
        text-align:center;        
    }
  
  p.invoice-mst-info{
        font-size: 10pt;
        line-height: 5px;
    }

/*   #item-table {
  border-collapse: collapse;
  } */
   tbody tr, thead tr{
    border: 1px solid #666;
  }
/*   #item-table tbody td, thead td  {
    border: 0px;
  }  */

  td span {
  background: #f2f0e4;
  padding: 0 20px;
  color: red;
}

#invoice_table td, th{
    padding: 5px;
}




</style>
</head>



<body>

    <div id="watermarkLogo" style="position: absolute; top: 120px;">
        @if ( preg_match("/127.0/", Request::ip()) )
            <img src="{{'localhost:8000'.'/../'.$proformacompanyData->watermarkLogo}}" alt="" style="width: 100%">
        @else
            <img src="{{str_replace('https', 'http', asset($proformacompanyData->watermarkLogo)) }}" style="width: 100%">
        @endif
    </div>
    
    <div style="position: relative;">
        <table width="100%" border="0" align="center">
        
            <tbody>
                <tr>
                    <td align="left"  width="60%">
                        @isset($cartapprovesData)
                            @if ( preg_match("/127.0/", Request::ip()) )
                                <img  src={{ 'localhost:8000'.'/../'.$proformacompanyData->logo }} alt="logo"    style="max-width: 400px; max-height:200px;">
                            @else
                                <img  src="{{str_replace('https', 'http', asset($proformacompanyData->logo)) }}" alt="logo"    style="max-width: 400px;  max-height:200px;">
                            @endif
                        @endisset
                    </td>

                    <td style="width: 0px; background: #666; " style="padding-left: 10px;"> </td>
                    
                    <td  align="right" width="40%"  style="padding-left: 10px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td colspan="3" style="font-weight: bold;">{{$proformainvoicecommonsettingsData->officeContactTitle}}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>:</td>
                                    <td style="text-align: justify; text-justify:inter-word; white-space : normal; overflow-wrap: break-word;">{!!$proformacompanyData->address!!}</td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>:</td>
                                    <td>{{$proformacompanyData->phone}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>{!! $proformacompanyData->email !!}</td>
                                </tr>
                                <tr>
                                    <td>Web</td>
                                    <td>:</td>
                                    <td>{!! $proformacompanyData->web !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    
                </tr>
            </tbody>
        </table>
    
    
        <br>
        <br>

        <table width="100%">
            <tr>
                <td style="width:60%">
                    <div style=" line-height: 3px;">
                        <p><strong>TO:</strong></p>
                        <p>Name: {{ strip_except_english($cartData->takingFor) }}
                            {{-- @if(isset($cartData->takingForLocalLang) and strlen(strip_except_english($cartData->takingForLocalLang))>0)
                                <strong>{{' ('.strip_except_english($cartData->takingForLocalLang).')'}}</strong>
                            @endif --}}
                        </p>
                        
                        <p style="line-height:13px;">
                            {{ strip_except_english($cartData->streethouse) }} 
                            {{--  {{ strip_except_english($cartData->streethouse).', '.strip_except_english($cartData->city) }}   --}}
                            {{-- @if( isset($cartData->streethouseLocalLang) and strlen(strip_except_english($cartData->streethouseLocalLang))>0)
                                {{ ', '.strip_except_english($cartData->streethouseLocalLang)}} 
                            @endif
                            @if(isset($cartData->cityLocalLang) and strlen(strip_except_english($cartData->cityLocalLang))>0)
                                {{ ', '.strip_except_english($cartData->cityLocalLang) }} 
                            @endif --}}
                        </p>
                        <p>
                            {{strip_except_english($cartData->city)}}
                        </p>
                        
                        {{-- <p>
                            @if(isset($cartData->streethouseLocalLang) and strlen(strip_except_english($cartData->streethouseLocalLang))>0)
                                {{ strip_except_english($cartData->streethouseLocalLang)}} 
                            @endif
                            @if(isset($cartData->cityLocalLang) and strlen(strip_except_english($cartData->cityLocalLang))>0)
                                {{ ', '.strip_except_english($cartData->cityLocalLang) }} 
                            @endif
                        </p> --}}
                
                        <p>
                            Post code: {{ $cartData->postalCode }}
                        </p>
                        <p>
                            Phone : {{ $cartData->phoneCode.$cartData->phone }}
                        </p>
                        <p>
                            {{ $countryData->where('countryId', $cartData->countryId )->pluck('country')->first() }}
                        </p>
                
                    </div>
                </td>
                <td style="width:40%">
                    <div style=" float: right; line-height: 1px;">
                        <h1 style="color: #666;">{{$invoicecommonsettingsData->invoiceTitle}}</h1>
                        <h4 >{{$invoicecommonsettingsData->invoiceTitle}}: {{process_order_number($cartData->cartId, $cartData->created_at)}}</h4>
                        <h4 >Date: {{\Carbon\Carbon::parse($cartData->paymentConfirmDate)->format('d.m.Y')}}</h4>
                    </div>
                </td>
            </tr>
        </table>
    
        
    
        
    
        <div>
            <p><strong>{{$invoicecommonsettingsData->commentTitle}}</strong></p>
            <p style="font-style: italic; font-weight: bold;">
                {{$invoicecommonsettingsData->declaration}}
            </p>
        </div>
    
    
    
        <table width="100%" border="1" align="center" style="border: 1px black;">
            <tr >
                <th align="center">Product</th>
                <th align="center">Packing</th>
                <th align="center">Quantity</th>
                <th align="center">FOB unit price</th>
                <th align="center">Amount ({{$cartData->currency}})</th>
            </tr >
            @foreach ($cartdetailsData as $cartdetail)
                <tr align="center">
                    <td align="left">
                        {{$cartdetail->genericBrand.' '. '('.$cartdetail->genericStrength.' '.$cartdetail->genericName.'), '.$cartdetail->dosageForm.' / manufactured by '.$cartdetail->genericCompany }}
                    </td>
                    <td>
                        {{$genericpacksizes_with_customer_price_Data->where('genericPackSizeId',  $cartdetail->genericPackSizeId)->pluck('genericPackSize')->first().'\'s'}}
                    </td>
                    <td>{{$cartdetail->qty.' '.$cartdetail->packType}}</td>
                    <td>
                        {{$cartdetail->price}}
                    </td>
                    <td>{{$cartdetail->subtotal}}</td>
                </tr>
            @endforeach
    
            
            <tr>
                <th colspan="4" style="text-align: right;">Sub Total</th>
                <th>{{$cartData->subTotalAmount}}</th>
            </tr>
            <tr>
                <th  colspan="4" style="text-align: right;">Discount</th>
                <th>{{$cartData->discount}}</th>
            </tr>
            <tr>
                <th  colspan="4" style="text-align: right;">Tax</th>
                <th>{{$cartData->tax}}</th>
            </tr>
            <tr>
                <th  colspan="4" style="text-align: right;">Shipping Cost</th>
                <th>{{$cartData->shippingAmount}}</th>
            </tr>
            <tr>
                <th  colspan="4" style="text-align: right;">Transaction Fee</th>
                <th>{{$cartData->transactionFeeAmount}}</th>
            </tr>
            <tr>
                <th colspan="4" style="text-align: right;">Net Payable</th>
                <th>{{$cartData->totalAmount}}</th>
            </tr>
    
            <tr>
                <th colspan="5">Amount in words: {{$cartData->currency}} {{$ntw}}</th>
            </tr>
            
            
            
        </table>
    
        <br>
        <br>
        <p>
            <h2 style="text-align: center">
                Thank You
            </h2>
        </p>
    </div>


        
        

    @if ($proformacompanyData->footerBackground &&  strlen($proformacompanyData->footerBackground)>5)
        <footer style="width: 120%; position: absolute; bottom: 0px; margin-left: -10%; margin-bottom: -5%;">
            @if ( preg_match("/127.0/", Request::ip()) )
                <img src="{{'localhost:8000'.'/../'.$proformacompanyData->footerBackground}}" alt="" style="width: 100%">
            @else
                <img src="{{str_replace('https', 'http', asset($proformacompanyData->footerBackground)) }}" style="width: 100%">
            @endif
        </footer> 
    @endif

    
            

</body>



</html>