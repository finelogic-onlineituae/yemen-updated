<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Form;
use Mpdf\Mpdf;


class PDFController extends Controller
{
    public function generate($id)
    {

        $application = Form::findOrFail($id);
   
         $data = [
            'application' => $application,
        ];
        $html = view('pdf.common', $data)->render();
      /*  switch ($application->form_type_id) {
            case '1':
                $html = view('pdf.birth-certificate', $data)->render();
                break;
            case '2':
                $html = view('pdf.driving-licence', $data)->render();
                break;
            case '3':
                $html = view('pdf.no-id-card', $data)->render();
                break;
            case '4':
                $html = view('pdf.power-of-attorney', $data)->render();
                break;
            case '5':
                $html = view('pdf.no-objection-certificate', $data)->render();
                break;
            case '6':
                $html = view('pdf.marriage-certificate', $data)->render();
                break;
            case '7':
                $html = view('pdf.support-statement', $data)->render();
                break;
            case '8':
                $html = view('pdf.kinship-family', $data)->render();
                break;
            case '9':
                $html = view('pdf.renew-passport-above', $data)->render();
                break;
            case '10':
                $html = view('pdf.renew-passport-below', $data)->render();
                break;
            case '11':
                $html = view('pdf.new-passport', $data)->render();
                break;
            case '12':
                $html = view('pdf.damaged-passport', $data)->render();
                break;
            case '13':
                $html = view('pdf.loss-passport', $data)->render();
                break;
            case '13':
                $html = view('pdf.loss-passport', $data)->render();
                break;
            case '15':
                $html = view('pdf.visa-application', $data)->render();
                break;
            case '16':
                $html = view('pdf.no-id-card-group', $data)->render();
                break;
            case '17':
                $html = view('pdf.school-certificate', $data)->render();
                break;
            case '18':
                $html = view('pdf.univercity-certificate', $data)->render();
                break;
            case '19':
                $html = view('pdf.other-certificate', $data)->render();
                break;

            default:
                abort(403);
                break;
        }
        */
        // return $html;
            $mpdf = new Mpdf([
            'margin_top'    => 5,
            'margin_right'  => 5,
            'margin_bottom' => 5,
            'margin_left'   => 5,
        ]);
            $mpdf->WriteHTML($html);
            $mpdf->Output($application->id.'.pdf', 'I');
        
    
      
    }

    public function generateadmin(Request $request, $id)
    {

        $apk=$request->query('apk');
        $application_print_key = config('certificate.application_print_key');

        if($apk==$application_print_key){

            $application = Form::findOrFail(deobfuscate_id($id));
    
            $data = [
                'application' => $application,
            ];
            switch ($application->form_type_id) {
                case '1':
                    $html = view('pdf.birth-certificate', $data)->render();
                    break;
                case '2':
                    $html = view('pdf.driving-licence', $data)->render();
                    break;
                case '3':
                    $html = view('pdf.no-id-card', $data)->render();
                    break;
                case '4':
                    $html = view('pdf.power-of-attorney', $data)->render();
                    break;
                case '5':
                    $html = view('pdf.no-objection-certificate', $data)->render();
                    break;
                case '6':
                    $html = view('pdf.marriage-certificate', $data)->render();
                    break;
                case '7':
                    $html = view('pdf.support-statement', $data)->render();
                    break;
                case '8':
                    $html = view('pdf.kinship-family', $data)->render();
                    break;
                case '9':
                    $html = view('pdf.renew-passport-above', $data)->render();
                    break;
                case '10':
                    $html = view('pdf.renew-passport-below', $data)->render();
                    break;
                case '11':
                    $html = view('pdf.new-passport', $data)->render();
                    break;
                case '12':
                    $html = view('pdf.damaged-passport', $data)->render();
                    break;
                case '13':
                    $html = view('pdf.loss-passport', $data)->render();
                    break;
                case '13':
                    $html = view('pdf.loss-passport', $data)->render();
                    break;
                case '15':
                    $html = view('pdf.visa-application', $data)->render();
                    break;
                case '16':
                $html = view('pdf.no-id-card-group', $data)->render();
                break;
                case '17':
                    $html = view('pdf.school-certificate', $data)->render();
                    break;
                case '18':
                    $html = view('pdf.univercity-certificate', $data)->render();
                    break;
                case '19':
                    $html = view('pdf.other-certificate', $data)->render();
                    break;

                default:
                    abort(403);
                    break;
            }
            
            // return $html;
                $mpdf = new Mpdf([
                'margin_top'    => 5,
                'margin_right'  => 5,
                'margin_bottom' => 5,
                'margin_left'   => 5,
            ]);
                $mpdf->WriteHTML($html);
                $mpdf->Output($application->id.'.pdf', 'I');
        
    
        }else{
             abort(403);
        }
    }
    

    public function generateForMail($id)
    {

        $application = Form::findOrFail(decrypt($id));
   
         $data = [
            'application' => $application,
        ];
        switch ($application->form_type_id) {
            case '1':
                $html = view('pdf.birth-certificate', $data)->render();
                break;
            case '2':
                $html = view('pdf.driving-licence', $data)->render();
                break;
            case '3':
                $html = view('pdf.no-id-card', $data)->render();
                break;
            case '4':
                $html = view('pdf.power-of-attorney', $data)->render();
                break;
            case '5':
                $html = view('pdf.no-objection-certificate', $data)->render();
                break;
            case '6':
                $html = view('pdf.marriage-certificate', $data)->render();
                break;
            case '7':
                $html = view('pdf.support-statement', $data)->render();
                break;
            case '8':
                $html = view('pdf.kinship-family', $data)->render();
                break;
            case '9':
                $html = view('pdf.renew-passport-above', $data)->render();
                break;
            case '10':
                $html = view('pdf.renew-passport-below', $data)->render();
                break;
            case '11':
                $html = view('pdf.new-passport', $data)->render();
                break;
            case '12':
                $html = view('pdf.damaged-passport', $data)->render();
                break;
            case '13':
                $html = view('pdf.loss-passport', $data)->render();
                break;
            // case '13':
            //     $html = view('pdf.loss-passport', $data)->render();
            //     break;
            case '15':
                $html = view('pdf.visa-application', $data)->render();
                break;
            case '16':
                $html = view('pdf.no-id-card-group', $data)->render();
                break;
            case '17':
                $html = view('pdf.school-certificate', $data)->render();
                break;
            case '18':
                $html = view('pdf.univercity-certificate', $data)->render();
                break;
            case '19':
                $html = view('pdf.other-certificate', $data)->render();
                break;

            default:
                abort(403);
                break;
        }
        
        // return $html;
            $mpdf = new Mpdf([
            'margin_top'    => 5,
            'margin_right'  => 5,
            'margin_bottom' => 5,
            'margin_left'   => 5,
        ]);
            $mpdf->WriteHTML($html);
            return $mpdf->Output('', 'S'); // Return PDF as string
        
    
      
    }
    
}
