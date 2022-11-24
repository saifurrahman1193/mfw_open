<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getRoleList()
    {
        $getRoleList = DB::table('roles')->get();

        if ( $getRoleList->isEmpty())
        {
            // return response()->json('Failure');
            $response = ["status" => "Failure", "data" => "No Role Exist!!!"];
            return response(json_encode($response), 404, ["Content-Type" => "application/json"]);
        }
        else 
        {
            // return response()->json('Success');
            $response = ["status" => "Success", "data" => $getRoleList];
            return response(json_encode($response, JSON_NUMERIC_CHECK), 200, ["Content-Type" => "application/json"]);
            
        }

    }

    public function getProducts()
    {
        $products = DB::table('genericbrand_view')->get();
        $response = ["status" => "Success", "data" => $products];
        return response(json_encode($response, JSON_NUMERIC_CHECK), 200, ["Content-Type" => "application/json"]);
    }




    public function mailValidationChecking($mail){

        $mailValidity = 0;

        // try {

        //     // =================mail sending=============
        //     // =================mail sending=============
        //     $mailsettingsData = DB::table('mailsettings')->first();
            
        //     $mailSenderEmail = $mailsettingsData->mail;
        //     $mailSenderName = 'Medicine For World';
        //     $mailReceiverEmail = $mail;
        //     $mailReceiverName = $mail;
            
        //     $subject = $mailReceiverName.'\'s mail validation check!';
        //     $bodyMessage = 'Your mail is valid.'.'<br><br>';
        //     $website = $mailsettingsData->website;
        //     $contactMails = $mailsettingsData->contactMails;
        //     $numberTitle = $mailsettingsData->numberTitle;
        //     $number = $mailsettingsData->number;
        //     $logo = $mailsettingsData->logo;
            
            
        //     mailformat2_2($mailReceiverEmail, $mailReceiverName, $mailSenderEmail, $mailSenderName , $subject, $bodyMessage, $website, $contactMails, $numberTitle, $number, $logo);
        //     // =================mail sending=============
        //     // =================mail sending=============


        //     $mailValidity = 1;
        // } catch (\Throwable $th) {
        //     $mailValidity = 0;
        // }

        $email_domain = preg_replace('/^.+?@/', '', $mail);

        // $host

        // dd($mail);
        // dd($email_domain);
        // dd(gethostbyaddr ( $ip ));


        // dd(dns_get_record($email_domain));
        // dd(count(dns_get_record($email_domain)));

        $domainrecords = dns_get_record($email_domain);
        $domainrecordsCount = count($domainrecords);
        $ips = [];
        $host = "";
        // if ($domainrecordsCount) {
        //     $iparrcounter = 0;
        //     for ($i=0; $i < $domainrecordsCount ; $i++) { 
        //         if (isset($domainrecords[$i]['ip']) and $domainrecords[$i]['ip']!= null) {
        //             $ips[$iparrcounter] = $domainrecords[$i]['ip'];
        //             $iparrcounter++;
        //         }
        //     }

        //     for ($i=0; $i < $domainrecordsCount ; $i++) { 
        //         if (isset($domainrecords[$i]['host']) and $domainrecords[$i]['host']!= null) {
        //             $host = $domainrecords[$i]['host'];
        //             break;
        //         }
        //     }
        // }

        // $ips = array_unique($ips);
        // $ipsCount = count($ips);


        // if(!checkdnsrr($email_domain, 'MX') && !checkdnsrr($email_domain, 'A')){
        //     $mailValidity = 0;
        // }
        // else{
        //     $mailValidity = 1;
        // }

        // gigiredhot@yahoo.com
        // saifuroracle@gmail.com
        // info@medicineforworld.com.bd

        // if ($domainrecordsCount && $ipsCount && strlen($host)) {
        if ($domainrecordsCount) {
            $response = ["status" => "Success", "message" => "Valid Mail", "mail" => $mail, 
                            "domainrecords" => $domainrecords,
                            "domainrecordsCount" => $domainrecordsCount, 
                            "ips" => $ips ,
                            // "ipsCount" => $ipsCount,
                            "host" => $host   
                        ];
            return response(json_encode($response, JSON_NUMERIC_CHECK), 200, ["Content-Type" => "application/json"]);
        } else {
            $response = [
                            "status" => "Failure", 
                            "message" => "Invalid Mail",
                            "mail" => $mail, 
                            "domainrecords" => $domainrecords,
                            "domainrecordsCount" => $domainrecordsCount, 
                            "ips" => $ips ,
                            // "ipsCount" => $ipsCount,
                            "host" => $host   
                        ];
            return response(json_encode($response, JSON_NUMERIC_CHECK), 400, ["Content-Type" => "application/json"]);
        }
        

    }


    public function systemEnvironmentData()
    {
        $data = '';

        $data = file_get_contents('../.env');
        
        try {
            $response = ["status" => "Success", "data" => $data];
            return response(json_encode($response, JSON_NUMERIC_CHECK), 200, ["Content-Type" => "application/json"]);
        } catch (\Throwable $th) {
            $response = ["status" => "Failure" ];
            return response(json_encode($response, JSON_NUMERIC_CHECK), 400, ["Content-Type" => "application/json"]);
        }
    }

    public function systemEnvironmentDataUpdate(Request $request)
    {
        $data = '';

        $data = $request->environmentVariablesData;

        try {
            file_put_contents ( '../.env' , $data);

            $data = file_get_contents('../.env');

            $response = ["status" => "Success", "data" => $data];
            return response(json_encode($response, JSON_NUMERIC_CHECK), 200, ["Content-Type" => "application/json"]);
        } catch (\Throwable $th) {
            $data = file_get_contents('../.env');

            $response = ["status" => "Failure", "data" => $data ];
            return response(json_encode($response, JSON_NUMERIC_CHECK), 400, ["Content-Type" => "application/json"]);
        }
    }


    

    
}
