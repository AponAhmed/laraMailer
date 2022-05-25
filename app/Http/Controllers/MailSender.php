<?php

namespace App\Http\Controllers;

use App\Models\Campain;
use App\Models\Contact;
use App\Models\GoogleAccount;
use Illuminate\Http\Request;
use Google_Service_Gmail_Draft;
use Google_Service_Gmail_Message;
use Google_Service_Gmail;

use Symfony\Component\VarDumper\VarDumper;


class MailSender extends Controller
{
    //
    private $debug = true;

    function index()
    {
        $campaigns = Campain::all();
        if ($campaigns->count() > 0) {
            if ($this->debug) {
                VarDumper::dump("Campaign Found : " . $campaigns->count());
            }
            foreach ($campaigns as $campaign) {
                $groups = json_decode($campaign->group, true);
                foreach ($groups as $groupID) {
                    //VarDumper::dump($groupID);
                    $contacts = Contact::where('group', "=", $groupID)->get();
                    if ($contacts->count() > 0) {
                        $this->contactLoop($contacts, $campaign);
                    } else {
                        VarDumper::dump("No Contact Found  in Campaign($campaign->name)");
                    }
                }
            }
        } else {
            VarDumper::dump("Campain Not Found !");
        }
    }

    private function contactLoop($contacts, $campaign)
    {
        foreach ($contacts as $contact) {
            if ($this->Mail2($contact->email, $campaign->subject, $campaign->body)) {
                //Update last Sent
                //Update Hourly Sent Count
                //Update Daly Sent Count
            }
            //VarDumper::dump($contact);
        }
    }


    function Mail2($to, $subject, $body)
    {
        $googleAcc = GoogleAccount::where("daily_limit", ">", "daily_send_count")
            ->where("auth_token", "<>", "null")
            ->limit(1)->get();
        $googleAccount = $googleAcc[0];


        $ApiService = new GoogleApiService($googleAccount);
        if ($ApiService->is_connected) {
            $service = new Google_Service_Gmail($ApiService->client);
            // Print the labels in the user's account.
            $message = $this->createMessage($googleAccount->email, $to, $subject, $body);

            $draft = new Google_Service_Gmail_Draft();
            $draft->setMessage($message);
            $draft = $service->users_drafts->create('me', $draft);
            $message = $service->users_messages->send('me', $message);

        }else{
            if ($this->debug) {
                VarDumper::dump("Copnnection Failed: " . $googleAccount->email);
            }
        }


        //dd($service);
        //exit;


        //($service->client);


        //$this->createDraft($service, 'me', $message);
    }


    /**
     * @param $sender string sender email address
     * @param $to string recipient email address
     * @param $subject string email subject
     * @param $messageText string email text
     * @return Google_Service_Gmail_Message
     */
    function createMessage($sender, $to, $subject, $messageText)
    {
        $message = new Google_Service_Gmail_Message();

        $rawMessageString = "From: <{$sender}>\r\n";
        $rawMessageString .= "To: <{$to}>\r\n";
        $rawMessageString .= 'Subject: =?utf-8?B?' . base64_encode($subject) . "?=\r\n";
        $rawMessageString .= "MIME-Version: 1.0\r\n";
        $rawMessageString .= "Content-Type: text/html; charset=utf-8\r\n";
        $rawMessageString .= 'Content-Transfer-Encoding: quoted-printable' . "\r\n\r\n";
        $rawMessageString .= "{$messageText}\r\n";

        $rawMessage = strtr(base64_encode($rawMessageString), array('+' => '-', '/' => '_'));
        $message->setRaw($rawMessage);
        return $message;
    }



    /**
     * @param $service Google_Service_Gmail an authorized Gmail API service instance.
     * @param $user string User's email address or "me"
     * @param $message Google_Service_Gmail_Message
     * @return Google_Service_Gmail_Draft
     */
    function createDraft($service, $user, $message)
    {
        $draft = new Google_Service_Gmail_Draft();
        $draft->setMessage($message);

        try {
            $draft = $service->users_drafts->create($user, $draft);
            print 'Draft ID: ' . $draft->getId();
        } catch (Exception $e) {
            print 'An error occurred: ' . $e->getMessage();
        }

        return $draft;
    }
    /**
     * @param $service Google_Service_Gmail an authorized Gmail API service instance.
     * @param $userId string User's email address or "me"
     * @param $message Google_Service_Gmail_Message
     * @return null|Google_Service_Gmail_Message
     */
    function sendMessage($service, $userId, $message)
    {
        try {
            $message = $service->users_messages->send($userId, $message);
            print 'Message with ID: ' . $message->getId() . ' sent.';
            return $message;
        } catch (Exception $e) {
            print 'An error occurred: ' . $e->getMessage();
        }

        return null;
    }
}
