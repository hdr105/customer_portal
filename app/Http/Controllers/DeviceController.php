<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProfileUpdateRequest;

use Illuminate\Http\Request;
use App\Devices;

use App\Http\Requests;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use SonarSoftware\CustomerPortalFramework\Controllers\ContactController;

class DeviceController extends Controller
{
    private $apiController;
    public function __construct()
    {
        //$this->apiController = new \SonarSoftware\CustomerPortalFramework\Controllers\ContractController();
    }

    public function index()
    {
        $user = get_user();
        $contact = $this->getContact();

        $data_devices = new Devices();
        $devices  = $data_devices->curl_request_fun($contact);
        return view("pages.devices.index", compact('devices'));
    }

     private function getContact()
    {
        if (!Cache::tags("profile.details")->has(get_user()->contact_id)) {
            $contactController = new ContactController();
            $contact = $contactController->getContact(get_user()->contact_id, get_user()->account_id);
            Cache::tags("profile.details")->put(get_user()->contact_id, $contact, 10);
        }
        return Cache::tags("profile.details")->get(get_user()->contact_id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function downloadContractPdf($id)
    {
        $base64 = $this->apiController->getSignedContractAsBase64(get_user()->account_id, $id);

        return response()->make(base64_decode($base64), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "attachment; filename=contract.pdf",
        ]);
    }
}
