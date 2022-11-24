<html>
<head>
  <title>Proforma Invoice</title>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">


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

#proformainvoice_table td, #proformainvoice_table th, #table-terms td, #table-terms th, #table-footer td, #table-footer th, #table-products td, #table-products th{
    padding: 5px;
}
</style>
</head>

<body>

    {{-- {{dd(str_replace('https', 'http', asset($proformacompanyData->logo)))}} --}}

    <table width="100%" border="0" align="center">
        
        <tbody>
            <tr>
                <td align="left"  width="60%">
                    @if ( preg_match("/127.0/", Request::ip()) )
                        <img  src={{ 'localhost:8000'.'/../'.$proformacompanyData->logo }} alt="logo"    style="max-width: 400px; max-height:200px;">
                    @else
                        <img  src="{{str_replace('https', 'http', asset($proformacompanyData->logo))}}" alt="logo"    style="max-width: 400px;  max-height:200px;">
                    @endif
                </td>

                <td style="width: 0px; background: #666; " > </td>
                
                <td  align="right" width="40%" style="padding-left: 10px;">
                    <table>
                        <tbody>
                            <tr>
                                <td colspan="3" style="font-weight: bold;">{{$proformainvoicecommonsettingsData->officeContactTitle}}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td style="text-align: justify; text-justify:inter-word; white-space: normal;">{!!$proformacompanyData->address!!}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td style="text-justify:inter-word; white-space: normal;">{!! $proformacompanyData->phone !!}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td style="text-justify:inter-word; white-space: normal;">{!! $proformacompanyData->email !!}</td>
                            </tr>
                            <tr>
                                <td>Web</td>
                                <td>:</td>
                                <td style="text-justify:inter-word; white-space: normal;">{!! $proformacompanyData->web !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                
            </tr>
        </tbody>
    </table>


    <hr style="color: #666;">
    <br>
    <br>

        
    <table width="100%" border="1" align="center" id="proformainvoice_table">
        <tbody>
            <tr >
                <th align="center" colspan="2">{{$proformainvoicecommonsettingsData->proformaInvoiceTitle}}</th>
            </tr>
            <tr>
                {{-- <td style="font-family: dejavu serif;"> --}}
                    <td >

                    <strong>{{$proformainvoicecommonsettingsData->consigneeTitle.' :'}}</strong> <br>
                    {{ strip_except_english($cartData->takingFor) }}
                    {{-- @if(isset($cartData->takingForLocalLang) and strlen(strip_except_english($cartData->takingForLocalLang))>0 )
                        <strong>{{' ('.strip_except_english($cartData->takingForLocalLang).')'}}</strong>
                    @endif --}}
                    <br>
                    {{ strip_except_english($cartData->streethouse).', '.strip_except_english($cartData->city) }} 
                    {{-- @if (!isset($cartData->streethouseLocalLang) and isset($cartData->cityLocalLang))
                        <br>
                    @endif
                    @if(isset($cartData->streethouseLocalLang) and strlen(strip_except_english($cartData->streethouseLocalLang))>0 )
                        {{ strip_except_english($cartData->streethouseLocalLang)}} 
                    @endif
                    @if( isset($cartData->cityLocalLang) and strlen(strip_except_english($cartData->cityLocalLang ))>0 )
                        {{ ', '.strip_except_english($cartData->cityLocalLang )}} 
                    @endif --}}

                    <br>
                    {{ $cartData->postalCode }} <br>
                    Phone : {{ $cartData->phoneCode.$cartData->phone }} <br>
                    {{ $countryData->where('countryId', $cartData->countryId )->pluck('country')->first() }} <br>
                </td>
                <td>
                    <strong>{{$proformainvoicecommonsettingsData->traderTitle.' :'}}</strong> <br>
                    {{-- {{$proformacompanyData->company}} <br>  --}}
                    {!! $proformacompanyData->address !!} <br> 
                    {{$proformacompanyData->phone}} <br> 
                    {!! $proformacompanyData->email !!} <br> 
                    {!! $proformacompanyData->web !!}

                </td>
            </tr>
            <tr>
                <td>
                    <strong>Invoice No: {{process_order_number($cartData->cartId, $cartData->created_at)}}</strong> <br>
                    Date : {{\Carbon\Carbon::parse($cartapprovesData->created_at)->format('d M, Y')}}
                </td>
                <td>
                    <strong>{{$proformainvoicecommonsettingsData->paymentMediaTitle.' :'}}</strong> <br>
                    {{ $cartapprovesData->paymentMethod}} 

                    @if ($proformacompanyData->paymentAccDetailsIsVisible==1)
                        <br> {!!$cartapprovesData->paymentAccountDetails!!}
                    @endif
                    
                </td>
            </tr>

            

            
        </tbody>
    </table>


    <table width="100%" border="1" style="border: 1px black;"  id="table-products">
        <tr align="center" >
            <th >Product</th>
            <th >Packing</th>
            <th >Quantity</th>
            <th >FOB unit price</th>
            <th >Amount ({{$cartData->currency}})</th>
        </tr>
        @foreach ($cartdetailsData as $cartdetail)
            <tr align="center">
                <td align="left">
                    {{$cartdetail->genericBrand.' '. '('.$cartdetail->genericStrength.' '.$cartdetail->genericName.'), '.$cartdetail->dosageForm.' / manufactured by '.$cartdetail->genericCompany }}
                </td>
                <td>
                    {{$genericpacksizes_with_customer_price_Data->where('genericPackSizeId',  $cartdetail->genericPackSizeId)->pluck('genericPackSize')->first().'\'s'}}
                </td>
                <td>{{$cartdetail->qty.' '.$cartdetail->packType }}</td>
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

    <table width="100%" border="1" style="border: 1px black;" id="table-terms">
        <tr>
            <th colspan="5" style="text-align: center;">Terms </th>
        </tr>
        <tr>
            <td colspan="5">
                <strong>Final Destination : {{$countryData->where('countryId', $cartData->countryId )->pluck('country')->first()}}</strong> <br>
                            {!! $proformainvoicecommonsettingsData->terms !!}
            </td>
            
        </tr>
        
        <tr>
            <td colspan="5">
                <strong>Declaration</strong><br>
                {{$proformainvoicecommonsettingsData->declaration}}
            </td>
        </tr>
    </table>

    <table width="100%" border="1" style="border: 1px black;" id="table-footer">
        <tr>
            <td>
                For,<br>
                {{$proformacompanyData->company}} <br><br>

                @if ( preg_match("/127.0/", Request::ip()) )
                    <img  src={{ 'localhost:8000'.'/../'.$proformacompanyData->signature }} alt=""    style="max-width: 75px; max-height: 50px; position:absolute;z-index:2;">
                    <img  src={{ 'localhost:8000'.'/../'.$proformacompanyData->seal }} alt=""    style="max-width: 75px; max-height: 50px; position:relative;z-index:1;margin-left:30px;">
                @else
                    <img  src="{{str_replace('https', 'http', asset($proformacompanyData->signature)) }}" alt=""    style="max-width: 75px; max-height: 50px;  position:absolute;z-index:2;">
                    <img  src="{{str_replace('https', 'http', asset($proformacompanyData->seal)) }}" alt=""    style="max-width: 75px; max-height: 50px;  position:relative;z-index:1;margin-left:30px;">
                @endif
                
                

                <br>
                Authorized Signature
                <br>
                <br>
            </td>
            <td>
                <p style="text-align: center;"><strong>Accepted</strong></p><br>
                For,<br>
                {{ $cartData->takingFor }}
                {{-- @isset($cartData->takingForLocalLang)
                    <strong>{{' ('.$cartData->takingForLocalLang.')'}}</strong>
                @endisset                                --}}
                
            </td>
        </tr>
    </table>

 


</body>
</html>