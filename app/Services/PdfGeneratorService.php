<?php

namespace App\Services;
use Fpdf\Fpdf;
class PdfGeneratorService
{
    public function gen_form_p($id, $application){
        // $pdf = new PDF_HTML();
        $pdf = new Fpdf(); 
        $pdf->AddPage();
        $pdf->SetMargins(15, 15, 15); 
        $watermark = public_path(). '/images/watermark.png';
        $pdf->Image($watermark, 30, 30);
        $pdf->SetFont('Arial', 'B', 12); 
        $pdf->Cell(0, 6, 'APPENDIX - VIII',0,1,'C');
        $pdf->Cell(0, 6, "FORM 'P'",0,1,'C');
        $pdf->Cell(0, 6, 'VIDE RULE 23, PAKISTAN CITIZENSHIP RULE, 1952',0,1,'C'); 
        $pdf->Cell(0, 6, 'APPLICATION FOR CERTIFICATE OF DOMICILE PAKISTAN',0,1,'C');
        $pdf->Ln(8);
        $pdf->SetFont('Arial','', 12); 
        $pdf->Cell(10, 6, '',0,0,'L');
        $pdf->Cell(20, 6, 'To',0,0,'L');
        $pdf->Cell(0, 6, 'The District Magistrate,',0,1,'L');

        $pdf->Cell(10, 6, '',0,0,'L');
        $pdf->Cell(20, 6, '',0,0,'L');
        $pdf->Cell(0, 6, 'Islamabad.',0,1,'L');
        
        $pdf->MultiCell(0, 10, 'I '.$application[0]->applicants->name .' S/D/W/O '.$application[0]->applicants->fathername . ' Date of Birth ' . $application[0]->applicants->date_of_birth . ' Present Address '.$application[0]->applicants->temporaryAddress .' Permanent Address '. $application[0]->applicants->permanentAddress .'. I was formerly the resident of 			. I have arrived in Capital Islamabad Tehsil Islamabad District Islamabad Rev/Admin Federal Area in Pakistan since '.$application[0]->applicants->date_of_arrival.'. I have been continuously residing in Pakistan since ' . $application[0]->applicants->date_of_birth . ' immediately preceding this declaration and I hereby express my intention to abandon my domicile of origin in my intention to take up my placed habitation in Pakistan during the reminder of my life.'); 
        $pdf->MultiCell(0, 10, '             I further affirm that I had not migrated to India & returned to Pakistan between the 1st March 1947 to the date of this application except on visa No.______ dated _________ issued by the Pakistan Passport office at _______');
        $pdf->SetFont('Arial', 'BU', 12); 
        $pdf->Cell(0, 10, 'Other particulars are given below:-',0,1,'L');
        $pdf->Cell(50, 10, 'Married/single:',0,0,'L');
        $pdf->SetFont('Arial', '', 12); 
        $pdf->Cell(0, 10, $application[0]->applicants->marital_status->marital_status ,0,1,'L');
        $pdf->SetFont('Arial', 'BU', 12);
        $pdf->Cell(50, 10, 'Name of Wife/Husband:',0,0,'L');
        $pdf->SetFont('Arial', '', 12); 
        $pdf->Cell(0, 10, $application[0]->applicants->fathername,0,1,'L');
        $pdf->SetFont('Arial', 'BU', 12);
        $pdf->Cell(0, 10, 'Name of Children & their ages including date of birth:',0,1,'L');
        $pdf->SetFont('Arial', '', 12); 
        foreach($application[0]->applicants->childerns as $child){
            $pdf->Cell(50, 10, $child->child_name,0,0,'L');
            $pdf->Cell(0, 10, $child->child_dob,0,1,'L');
        }
        $pdf->SetFont('Arial', 'BU', 12);
        $pdf->Cell(70, 10, 'Trade & Occupation:',0,0,'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, $application[0]->applicants->occupations->occupation,0,1,'L');

        $pdf->Cell(0, 10, 'Do solemnly affirm that the above statement is true of the best of my knowledge and belief.',0,1,'L');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Ln(8);
        $pdf->Cell(120, 10, '',0,0,'L');
        $pdf->Cell(0, 10, 'Signature: ________________',0,1,'L');
        $pdf->Cell(120, 10, '',0,0,'L');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(20, 10, 'CNIC:      ',0,0,'L');
        $pdf->SetFont('Arial', 'U', 12);
        $pdf->Cell(0, 10, $application[0]->applicants->cnic,0,1,'L');
        $pdf->Cell(120, 10, '',0,0,'L');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(20, 10, 'Contact:',0,0,'L');
        $pdf->SetFont('Arial', 'U', 12);
        $pdf->Cell(0, 10, $application[0]->applicants->contact,0,1,'L');
        $pdf_path = storage_path('app\public\certificates\form-p'.$id.'.pdf');
        $pdf->Output('F', $pdf_path);
    }

    public function gen_pdf($id, $application){
        $pdf = new Fpdf(); 
        $pdf->AddPage(); 
        $watermark = public_path(). '/images/watermark.png';
        $pdf->Image($watermark, 30, 0);
        $pdf->SetFont('Arial', 'B', 12); 
        $pdf->Cell(0, 6, 'GOVERNMENT OF PAKISTAN',0,1,'C');
        $pdf->Cell(0, 6, 'OFFICE OF THE DEPUTY COMMISSIONER',0,1,'C');
        $pdf->Cell(0, 6, 'ISLAMABAD CAPITAL TERRITORY',0,1,'C'); 
        $pdf->Cell(0, 6, '****',0,1,'C');
        
        $pdf->SetFont('Arial','', 12); 
        $pdf->Cell(50, 6, 'No.'. $id .'/Domicile/CFC',0,0,'L');
        $pdf->Cell(0, 6, 'Dated: '.\Carbon\Carbon::now()->toDateString(),0,1,'R');
        if ($application[0]->users->user_type_id==2){
            $pdf->Ln(8);
            $pdf->Cell(5, 6, '',0,0,'L');
            $pdf->Cell(20, 6, 'To',0,0,'L');
            $pdf->Cell(50, 6, 'The '.$application[0]->users->fathername, 0,1,'L' );
            $pdf->Cell(25, 6, '',0,0,'L');
            $pdf->Cell(50, 6, $application[0]->users->name, 0,1,'L' );
            
            $pdf->Cell(25, 6, '',0,0,'L');
            $pdf->Cell(130, 6, 'Islamabad', 0,1,'L' );

            $pdf->Ln(6);

            $pdf->SetFont('Arial', 'B', 12); 
            $pdf->Cell(25, 6, 'Subject: ', 0,0,'L' );
            $pdf->SetFont('Arial', 'BU', 12); 
            $pdf->Cell(0, 6, 'VERIFICATION OF DOMICILE', 0,0,'L' );
        }else{
            $pdf->SetFont('Arial', 'BU', 12); 
            $pdf->Cell(0, 6, 'TO WHOM IT MAY CONCERN',0,1,'C');
        }
        
    
        $pdf->Ln(8); 
        
        // Add multi-cell text 
        $pdf->SetFont('Arial','', 12); 
        $pdf->MultiCell(0, 10, '                It is verified that Domicile Certificate issued to Mr/Mrs/Miss. '. $application[0]->applicants->name .' s/d/w/o '. $application[0]->applicants->fathername .' having CNIC No. '. $application[0]->applicants->cnic .' vide domicie number '. $application[0]->applicants->domicile_number .' dated '. $application[0]->applicants->issuance_date .' is geninue and is issued from this office.'); 
        // $signature = public_path(). '/images/signature.jpeg';
        // if ($application[0]->users->user_type_id==2){
        //     $pdf->Image($signature, 128, 105, 50); 
        // }else{
        //     $pdf->Image($signature, 128, 85, 50); 
        // }
        
        $pdf->Ln(8);
        $pdf->Line(10,85,200,85);
        $pdf->SetFont('Arial','B', 12); 
        $pdf->Cell(0, 6, 'Note:- This is electronicly approved certifiate and dose not required manuel signatures.',0,0);
        
        // $pdf->Cell(105, 6, '',0,0);
        // $pdf->Cell(0, 6, 'Assistant Commissioner (Saddar)',0,1);
        
        // $pdf->Cell(125, 6, '',0,0);
        // $pdf->Cell(0, 6, 'Islamabad',0,1);

        // Output the PDF directly to the browser 
        
        $pdf_path = storage_path('app\public\certificates\verification'.$id.'.pdf');
        $pdf->Output('F', $pdf_path);
    }
}
