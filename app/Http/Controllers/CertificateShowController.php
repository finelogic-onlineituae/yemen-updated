<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class CertificateShowController extends Controller
{
    public function certificate($id){
        
        $application = Form::findOrFail(deobfuscate_id($id));
   
         $data = [
            'application' => $application,
        ];
         return  view('certificate.base-template', $data);
        // switch ($application->form_type_id) {
        //     case '1':
        //         return  view('certificate.birth-certificate', $data);
        //         break;
        //     case '2':
        //         return    view('certificate.driving-licence', $data);
        //         break;
        //     case '3':
        //         return    view('certificate.no-id-card', $data);
        //         break;
        //     case '4':
        //         return    view('certificate.power-of-attorney', $data);
        //         break;
        //     case '5':
        //         return    view('certificate.no-objection-certificate', $data);
        //         break;
        //     case '6':
        //         return    view('certificate.marriage-certificate', $data);
        //         break;
        //     case '7':
        //         return    view('certificate.support-statement', $data);
        //         break;
        //     case '8':
        //          return   view('certificate.kinship-family', $data);
        //         break;
        //     case '9':
        //         return    view('certificate.renew-passport-above', $data);
        //         break;
        //     case '10':
        //         return    view('certificate.renew-passport-below', $data);
        //         break;
        //     case '11':
        //         return    view('certificate.new-passport', $data);
        //         break;
        //     case '12':
        //         return    view('certificate.damaged-passport', $data);
        //         break;
        //     case '13':
        //         return    view('certificate.loss-passport', $data);
        //         break;
        //     case '15':
        //         return    view('certificate.visa-application', $data);
        //         break;
        //     case '16':
        //         return    view('certificate.no-id-card-group', $data);
        //         break;
        //     default:
        //         abort(403);
        //         break;
        // }
    }
}
