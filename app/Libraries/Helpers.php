<?php
    function oneTo99Check($number)
    {
        // $number = 1;
        // $number = 101;
        // $number = 99;
        // $number = 199;
        $condition = false;

        
        $number = $number%100;
        // dd($number);
        if (in_array($number, range(1, 99))) 
        {
            $condition=true;
        }

        return $condition;
    }

    function numberFormat($number, $decimals=0)
    {

        // $number = 555;
        // $decimals=0;
        // $number = 555.000;
        // $number = 555.123456;

        if (strpos($number,'.')!=null) 
        {
            $decimalNumbers = substr($number, strpos($number,'.'));
            $decimalNumbers = substr($decimalNumbers, 1, $decimals);
        }
        else 
        {
            $decimalNumbers = 0;
            for ($i = 2; $i <=$decimals ; $i++) 
            {
                $decimalNumbers = $decimalNumbers.'0';
            }
        }
        // return $decimalNumbers;



        $number = (int) $number;
        // reverse
        $number = strrev($number);

        $n = '';
        $stringlength = strlen($number);

        for ($i = 0; $i < $stringlength; $i++)
        {
            if ($i%2==0 && $i!=$stringlength-1 && $i>1)
            {
                $n = $n.$number[$i].',';
            }
            else
            {
                $n = $n.$number[$i];
            }
        }

        $number = $n;
        // reverse
        $number = strrev($number);

        ($decimals!=0)? $number=$number.'.'.$decimalNumbers : $number ;

        return $number;
    }

    function partially_hide_email($email)
    {
        $em   = explode("@",$email);
        $name = implode('@', array_slice($em, 0, count($em)-1));
        // $len  = floor(strlen($name)/2);
        $len  = 5;
        $afterat = end($em);
        $afteratbeforedot = substr($afterat,0,strpos($afterat, '.'));
        $afteratbeforedot2char = substr($afteratbeforedot, -2);
        $afteratafterdot = substr($afterat,strpos($afterat, '.'));

        return substr($name,0, 2) . str_repeat('*', $len) . "@" .str_repeat('*', $len). $afteratbeforedot2char.$afteratafterdot;   
    }

    function getLastWord($sentence)
    {
        $pieces = explode(' ', $sentence);
        $last_word = array_pop($pieces);

        return $last_word;   
    }

    
    function setSessionLanguage()
    {
        if ( app()->getLocale() ) 
        {
            session([app()->getLocale()]);
        }
        else if ( app()->getLocale() )
        {
            session([app()->getLocale()]);
        } 
        else
        {
            session(['lang' => 'en']);
        }

    }


    function process_order_number($cartId, $created_at)
    {
        $orderNumber = '#'.$cartId.Carbon\Carbon::parse($created_at)->format('my');
        return $orderNumber;
    }

    function dmyToYmd($date)
    {
        if ($date) {
            $date = substr($date, 6,4).'-'.substr($date, 3,2).'-'.substr($date, 0,2);
            return $date;
        } else {
            return '';
        }
    }

    // carbondatetimeToYmd(\Carbon\Carbon::now())
    function carbondatetimeToYmd($datetime)
    {
        if ($datetime) {
            $date = \Carbon\Carbon::parse($datetime)->format('Y-m-d');
            return $date;
        } else {
            return '';
        }
    }

    // carbondatetimeToDayNumberOfYear('2021-02-12 17:04:05.084512')
    // carbondatetimeToDayNumberOfYear(\Carbon\Carbon::now())
    function carbondatetimeToDayNumberOfYear($datetime)
    {
        if ($datetime) {
            $DayNumberOfYear = \Carbon\Carbon::parse($datetime)->dayOfYear ;
            return $DayNumberOfYear+1;
        } else {
            return '';
        }
    }

    function YmdTodmY($date)
    {
        if ($date) {
            $date = \Carbon\Carbon::parse($date)->format('d-m-Y');
            return $date;
        } else {
            return '';
        }
    }

    function YmdTodmYDay($date)
    {
        if ($date) {
            $date = \Carbon\Carbon::parse($date)->format('d-m-Y  (l)');
            return $date;
        } else {
            return '';
        }
    }

    function YmdTodmYPm($datetime)
    {
        if ($datetime) {
            $date = \Carbon\Carbon::parse($datetime)->format('d-m-Y  g:i A');
            return $date;
        } else {
            return '';
        }
    }

    function YmdTodmYPmgiA($datetime)
    {
        if ($datetime) {
            $date = \Carbon\Carbon::parse($datetime)->format('g:i A');
            return $date;
        } else {
            return '';
        }
    }

    function YmdTodmYPmdMy($datetime)
    {
        if ($datetime) {
            $date = \Carbon\Carbon::parse($datetime)->format('d M, y ');
            return $date;
        } else {
            return '';
        }
    }

    
    function mailformat1($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo, $cartData, $cartdetailsData, $genericpacksizes_with_customer_price_Data, $countryData, $deliverymethodsData)
    {
        $data = array(
            [
                'mailReceiverEmail' => $mailReceiverEmail, 
                'mailReceiverName' => $mailReceiverName, 
                'mailSenderEmail' => $mailSenderEmail, 
                'mailSenderName' => $mailSenderName , 
                'subject' => $subject, 
                'bodyMessage' => $bodyMessage, 
                'website' => $website, 
                'contactMails' => $contactMails, 
                'numberTitle' => $numberTitle, 
                'number' => $number, 
                'logo' => $logo,
                'cartData' => $cartData,
                'cartdetailsData' => $cartdetailsData,
                'genericpacksizes_with_customer_price_Data' => $genericpacksizes_with_customer_price_Data,
                'countryData' => $countryData,
                'deliverymethodsData' => $deliverymethodsData

            ]
        );

        // dd($data);
        // dd($data[0]);
        // dd($data[0]['mailSenderEmail']);

        

        try{
            Mail::send('mails.mailformat1', $data[0], function ($message)  use ($data) {
                $message->to($data[0]['mailReceiverEmail'], $data[0]['mailReceiverName'])
                        ->bcc($data[0]['mailSenderEmail'])
                        // ->bcc('1193saifur@gmail.com')
                        ->bcc('medicineforworld@gmail.com')
                        // ->bcc('masudalimran92@gmail.com')
                        // ->bcc('yasir08arafat@yahoo.com')
                        ->bcc('medicineforworld@icloud.com')
                        ->bcc('medicineforworld@yahoo.com')
                        // ->bcc('saifur1193@hotmail.com')
                        // ->bcc('saifurrahman1993@yahoo.com')
                        ->replyTo('info@medicineforworld.com.bd', 'Medicine For World')
                        ->sender('noreply@medicineforworld.com.bd', 'Medicine For World')
                        ->priority(1)
                        ->returnPath('noreply@medicineforworld.com.bd')
                        ->subject($data[0]['subject']);
                $message->from($data[0]['mailSenderEmail'], $data[0]['mailSenderName']);
            });
        }
        catch (Exception $e) {
            DB::table('errors')->insert([
                'error' => 'Mail Sending Error - Order related -'.$e->getMessage()
            ]);
        }

    }


    function priceinquiremailformat($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo, $cgenericName, $cgenericCompany, $cdosageForm, $cgenericPackSize, $cprescription, $cgenericStrength, $cpackType, $cmessage, $cgenericBrandName, $cgenericBrandId, $cinquirerId ,$cname, $cmail )
    {
        $data = array(
            [
                'mailReceiverEmail' => $mailReceiverEmail, 
                'mailReceiverName' => $mailReceiverName, 
                'mailSenderEmail' => $mailSenderEmail, 
                'mailSenderName' => $mailSenderName , 
                'subject' => $subject, 
                'bodyMessage' => $bodyMessage, 
                'website' => $website, 
                'contactMails' => $contactMails, 
                'numberTitle' => $numberTitle, 
                'number' => $number, 
                'logo' => $logo,
                'cgenericName' => $cgenericName,
                'cgenericCompany' => $cgenericCompany,
                'cdosageForm' => $cdosageForm,
                'cgenericPackSize' => $cgenericPackSize,
                'cprescription' => $cprescription,
                'cgenericStrength' => $cgenericStrength,
                'cpackType' => $cpackType,
                'cmessage' => $cmessage,
                'cgenericBrandName' => $cgenericBrandName,
                'cgenericBrandId' => $cgenericBrandId,
                'cinquirerId' => $cinquirerId,
                'cname' => $cname,
                'cmail' => $cmail,

            ]
        );

        // dd($data);
        // dd($data[0]);
        // dd($data[0]['mailSenderEmail']);

        

        try{
            Mail::send('mails.priceinquiry', $data[0], function ($message)  use ($data) {
                $message->to($data[0]['mailReceiverEmail'], $data[0]['mailReceiverName'])
                        ->bcc($data[0]['mailSenderEmail'])
                        // ->bcc('1193saifur@gmail.com')
                        ->bcc('medicineforworld@gmail.com')
                        // ->bcc('masudalimran92@gmail.com')
                        ->bcc('medicineforworld@icloud.com')
                        ->bcc('medicineforworld@yahoo.com')
                        // ->bcc('saifur1193@hotmail.com')
                        // ->bcc('saifurrahman1993@yahoo.com')
                        ->replyTo('info@medicineforworld.com.bd', 'Medicine For World')
                        ->sender('noreply@medicineforworld.com.bd', 'Medicine For World')
                        ->priority(1)
                        ->returnPath('noreply@medicineforworld.com.bd')
                        ->subject($data[0]['subject']);
                $message->from($data[0]['mailSenderEmail'], $data[0]['mailSenderName']);
            });
        }
        catch (Exception $e) {
            DB::table('errors')->insert([
                'error' => 'Mail Sending Error -Price inquiry- '.$e->getMessage()
            ]);
        }

    }




    function mailformat2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo)
    {
        $data = array(
            [
                'mailReceiverEmail' => $mailReceiverEmail, 
                'mailReceiverName' => $mailReceiverName, 
                'mailSenderEmail' => $mailSenderEmail, 
                'mailSenderName' => $mailSenderName , 
                'subject' => $subject, 
                'bodyMessage' => $bodyMessage, 
                'website' => $website, 
                'contactMails' => $contactMails, 
                'numberTitle' => $numberTitle, 
                'number' => $number, 
                'logo' => $logo,
            ]
        );

        // dd($data);
        // dd($data[0]);
        // dd($data[0]['mailSenderEmail']);

        

        try{
            Mail::send('mails.mailformat2', $data[0], function ($message)  use ($data) {
                $message->to($data[0]['mailReceiverEmail'], $data[0]['mailReceiverName'])
                        ->bcc($data[0]['mailSenderEmail'])
                        // ->bcc('1193saifur@gmail.com')
                        ->bcc('medicineforworld@gmail.com')
                        // ->bcc('masudalimran92@gmail.com')
                        ->bcc('medicineforworld@icloud.com')
                        ->bcc('medicineforworld@yahoo.com')
                        // ->bcc('saifur1193@hotmail.com')
                        // ->bcc('saifurrahman1993@yahoo.com')
                        ->replyTo('info@medicineforworld.com.bd', 'Medicine For World')
                        ->sender('noreply@medicineforworld.com.bd', 'Medicine For World')
                        ->priority(1)
                        ->returnPath('noreply@medicineforworld.com.bd')
                        ->subject($data[0]['subject']);
                $message->from($data[0]['mailSenderEmail'], $data[0]['mailSenderName']);
            });
        }
        catch (Exception $e) {
            DB::table('errors')->insert([
                'error' => 'Mail Sending Error - Order related -'.$e->getMessage()
            ]);
        }

    }

    function mailformat2_1($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo)
    {
        $data = array(
            [
                'mailReceiverEmail' => $mailReceiverEmail, 
                'mailReceiverName' => $mailReceiverName, 
                'mailSenderEmail' => $mailSenderEmail, 
                'mailSenderName' => $mailSenderName , 
                'subject' => $subject, 
                'bodyMessage' => $bodyMessage, 
                'website' => $website, 
                'contactMails' => $contactMails, 
                'numberTitle' => $numberTitle, 
                'number' => $number, 
                'logo' => $logo,
            ]
        );

        // dd($data);
        // dd($data[0]);
        // dd($data[0]['mailSenderEmail']);

        

        try{
            Mail::send('mails.mailformat2', $data[0], function ($message)  use ($data) {
                $message->to('medicineforworld@gmail.com', $data[0]['mailReceiverName'])
                        ->bcc($data[0]['mailSenderEmail'])
                        // ->bcc('1193saifur@gmail.com')
                        // ->bcc('masudalimran92@gmail.com')
                        ->bcc('medicineforworld@icloud.com')
                        ->bcc('medicineforworld@yahoo.com')
                        // ->bcc('saifur1193@hotmail.com')
                        // ->bcc('saifurrahman1993@yahoo.com')
                        ->replyTo('info@medicineforworld.com.bd', 'Medicine For World')
                        ->sender('noreply@medicineforworld.com.bd', 'Medicine For World')
                        ->priority(1)
                        ->returnPath('noreply@medicineforworld.com.bd')
                        ->subject($data[0]['subject']);
                $message->from($data[0]['mailSenderEmail'], $data[0]['mailSenderName']);
            });
        }
        catch (Exception $e) {
            DB::table('errors')->insert([
                'error' => 'Mail Sending Error - Order related -'.$e->getMessage()
            ]);
        }

    }



    function mailformat2_2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo)
    {
        $data = array(
            [
                'mailReceiverEmail' => $mailReceiverEmail, 
                'mailReceiverName' => $mailReceiverName, 
                'mailSenderEmail' => $mailSenderEmail, 
                'mailSenderName' => $mailSenderName , 
                'subject' => $subject, 
                'bodyMessage' => $bodyMessage, 
                'website' => $website, 
                'contactMails' => $contactMails, 
                'numberTitle' => $numberTitle, 
                'number' => $number, 
                'logo' => $logo,
            ]
        );


        Mail::send('mails.mailformat2', $data[0], function ($message)  use ($data) {
            $message->to($data[0]['mailReceiverEmail'], $data[0]['mailReceiverName'])
                    ->bcc('medicineforworld@gmail.com')
                    ->bcc('medicineforworld@icloud.com')
                    ->bcc('medicineforworld@yahoo.com')
                    // ->bcc('masudalimran92@gmail.com')
                    ->replyTo('info@medicineforworld.com.bd', 'Medicine For World')
                    ->sender('noreply@medicineforworld.com.bd', 'Medicine For World')
                    ->priority(1)
                    ->returnPath('noreply@medicineforworld.com.bd')
                    ->subject($data[0]['subject']);
            $message->from($data[0]['mailSenderEmail'], $data[0]['mailSenderName']);
        });
       

    }


    function emailreplace($email){

        $email = str_replace('@','[at]' , $email);
        $email = str_replace('.','[dot]' , $email);
        return $email;
    }

    function strip_except_english($str){

        // $str = preg_replace('/[^0-9A-Za-z\-]/', '', $str);
        $str = preg_replace('/\p{Han}+/u', '', $str);  // strip chinese
        $str = preg_replace('/[\x{0410}-\x{042F}]+.*[\x{0410}-\x{042F}]+/iu', '', $str);  // strip russian
        return $str;
    }

    function cacheRemove()
    {
        try {
            \Artisan::call('cache:clear');
            \Artisan::call('config:cache');
        } catch (\Throwable $th) {
        }
    }


    function getLocaleFromUrl($url)
    {
        $baseUrl = url('/');

        if(strpos($url,$baseUrl.'/en') !== false || (strpos($url,$baseUrl.'/en/cn') !== false)  || (strpos($url,$baseUrl.'/en/ru') !== false))
        {
            return 'en';
        }
        elseif(strpos($url,$baseUrl.'/cn') !== false || (strpos($url,$baseUrl.'/cn/en') !== false)  || (strpos($url,$baseUrl.'/cn/ru') !== false))
        {
            return 'cn';
        }
        elseif(strpos($url,$baseUrl.'/ru') !== false || (strpos($url,$baseUrl.'/ru/en') !== false)  || (strpos($url,$baseUrl.'/ru/cn') !== false))
        {
            return 'ru';
        }
        else{
            return 'en';
        }
    }


    // algorithms

    // prime numbers
    function isPrime($n)
    {
        // Corner case
        if ($n <= 1)
            return false;
    
        // Check from 2 to n-1
        for ($i = 2; $i < $n; $i++)
            if ($n % $i == 0)
                return false;
    
        return true;
    }


    function getToday()
    {
        return date('Y-m-d');
    }

    function getNow()
    {
        return \Carbon\Carbon::now();
    }



    // block listing
    // block listing
    function blocklisting($name='', $email='', $blockTypeId='')
    {
        DB::table('blocklist')->where('email', $email)->where('blockTypeId', $blockTypeId)->delete();
        
        DB::table('blocklist')->insert([
            'name' => $name,
            'email' => $email,
            'blockTypeId' => $blockTypeId,
        ]);
    }

    function checkIsBlackListed($email='', $blockTypeId='')
    {
        $isBlackListed = false;
        if (DB::table('blocklist')->where('email', trim($email))->where('blockTypeId', $blockTypeId)->count() ) 
        {
            $isBlackListed = true;
        } 
        return $isBlackListed;
    }
    
    // block listing
    // block listing


    function tagGenerators($str='') 
    {
        $tags = ''; 
        if(strlen($str)>0)
        {
            $arr = explode(",",$str);
            foreach ($arr as $key => $value) 
            {
                $tags = $tags.' #'.$arr[$key];
            }
            $tags = trim($tags);
        }
        return $tags;
    }



?>