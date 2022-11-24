<html>
<head>
  <title>Duplicate Invoice</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
    {{--  {{ dd($proformacompanyData) }}  --}}
    <div id="watermarkLogo" style="position: absolute; top: 120px;">
        @if ( preg_match("/127.0/", Request::ip()) )
            <img src="{{'localhost:8000'.'/../'.$proformacompanyData->watermarkLogo}}" alt="" style="width: 100%">
        @else
            <img src="{{ str_replace('https', 'http', asset($proformacompanyData->watermarkLogo ))}}" style="width: 100%">
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
                                <img  src="{{ str_replace('https', 'http', asset($proformacompanyData->logo)) }}" alt="logo"    style="max-width: 400px;  max-height:200px;">
                            @endif
                        @endisset
                    </td>

                    <td style="width: 0px; background: #666; " > </td>
                    
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
                                    <td  style="text-justify:inter-word; white-space: normal;"> {!! $proformacompanyData->phone !!}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td  style="text-justify:inter-word; white-space: normal;"> {!! $proformacompanyData->email !!}</td>
                                </tr>
                                <tr>
                                    <td>Web</td>
                                    <td>:</td>
                                    <td  style="text-justify:inter-word; white-space: normal;"> {!! $proformacompanyData->web !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    
                </tr>
            </tbody>
        </table>
    
    
        <br>
        <br>
    
        <div style=" float: right; line-height: 1px;">
            <h1 style="color: #666;">{{$invoicecommonsettingsData->invoiceTitle}}</h1>
            <h4 >{{$invoicecommonsettingsData->invoiceTitle}}: {{process_order_number($cartData->cartId, $cartData->created_at)}}</h4>
            <h4 >Date: {{\Carbon\Carbon::parse($cartData->duplicateInvoiceDate)->format('d.m.Y')}}</h4>
        </div>
    
        <div style=" line-height: 3px;">
            <p><strong>TO:</strong></p>
            <p>Name: {{ $cartData->takingFor }}
                {{-- @isset($cartData->takingForLocalLang)
                    <strong>{{' ('.$cartData->takingForLocalLang.')'}}</strong>
                @endisset --}}
            </p>
            
            <p>
                {{ $cartData->streethouse.', '.$cartData->city }} 
                {{-- @isset($cartData->streethouseLocalLang)
                    {{ ', '.$cartData->streethouseLocalLang}} 
                @endisset
                @isset($cartData->cityLocalLang)
                    {{ ', '.$cartData->cityLocalLang }} 
                @endisset --}}
            </p>
            
            {{-- <p>
                @isset($cartData->streethouseLocalLang)
                    {{ $cartData->streethouseLocalLang}} 
                @endisset
                @isset($cartData->cityLocalLang)
                    {{ ', '.$cartData->cityLocalLang }} 
                @endisset
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
    
        <div>
            <p><strong>{{$invoicecommonsettingsData->commentTitle}}</strong></p>
            <p style="font-style: italic; font-weight: bold;">
                {{$invoicecommonsettingsData->declaration}}
            </p>
        </div>
    
    
    
        <table width="100%" border="1" style="border: 1px black;">
            <tr  align="center">
                <th>Product</th>
                <th >Unit Price ({{$cartData->currency}})</th>
                <th >Quantity</th>
                <th >Amount ({{$cartData->currency}})</th>
            </tr>
            @foreach ($cartdetailsData->where('fakeProductVisible', 1) as $cartdetail)
                <tr  align="center">
                    <td  align="left">{{ $cartdetail->fakeProduct }}</td>
                    <td>{{$cartdetail->fakePrice}}</td>
                    <td>{{$cartdetail->fakeQty}}</td>
                    <td>{{$cartdetail->fakeSubAmount}}</td>
                </tr>
            @endforeach
            
            <tr>
                <th colspan="3" style="text-align: right;">Total</th>
                <th  align="center">{{$totalFakeAmount}}</th>
            </tr>
    
            <tr>
                <th colspan="4">Amount in words: {{$cartData->currency}} {{$ntw}}</th>
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


        
        
    @if ( isset($proformacompanyData->footerBackground) &&  strlen($proformacompanyData->footerBackground)>5)

        <footer style="width: 120%; position: absolute; bottom: 0px; margin-left: -10%; margin-bottom: -5%;">
            @if ( preg_match("/127.0/", Request::ip()) )
                <img src="{{'localhost:8000'.'/../'.$proformacompanyData->footerBackground}}" alt="" style="width: 100%">
            @else
                <img src="{{ str_replace('https', 'http', asset($proformacompanyData->footerBackground ))}}" style="width: 100%">
            @endif
        </footer> 
    @endif

    
            

</body>



</html>