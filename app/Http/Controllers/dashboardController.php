<?php

namespace App\Http\Controllers;
use Fpdf\Fpdf;
use Fpdf\html2pdf;
use App\Models\applicants;
use App\Models\application;
use App\Models\application_statuses;
use App\Models\childern;
use App\Models\conversation;
use App\Models\district;
use App\Models\document;
use App\Models\gender;
use App\Models\marital_status;
use App\Models\occupation;
use App\Models\province;
use App\Models\qualification;
use App\Models\tehsil;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use PDF_HTML;
use phpDocumentor\Reflection\PseudoTypes\LowercaseString;

class dashboardController extends Controller
{
    public function test(){
        // $applicants = applicants::with('marital_status')->findorfail(14);
        $application = application::with(['applicants'=>function($query){
            $query->select('id', 'cnic', 'name', 'fathername', 'date_of_birth', 
            'date_of_arrival', 'temporaryAddress', 'permanentAddress', 'marital_status_id', 'occupation_id')
            ->with('childerns', 'marital_status', 'occupations');
            }])->where('id', '28')->get();
            $this->gen_form_p(28, $application);
            return $application;
    }
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
    public function index(Request $request){
        $user = Auth::user();
        if ($user->role==1){
            $user_apps = application::with('application_statuses')
                                    ->with('documents')
                                    ->with('applicants')
                                    ->with(["conversations" => function($query) use ($user){
                                        $query->select('id', 'application_id')
                                        ->where("is_receiver_see", "0")
                                        ->where('receiver_id', $user->id);}])
                                    ->with('application_types')
                                    ->where('user_id', '=', $user->id)
                                    ->paginate(10);
                                    
        }else{
            $query = application::with('application_statuses')
                                    ->with('documents')
                                    ->with('applicants')
                                    ->with(["conversations" => function($query)use ($user){$query->select('id', 'application_id')->where("is_receiver_see", "0")->where('receiver_id', $user->id);}])
                                    ->with('application_types');
            if (!empty($request->search)) { 
                if($request->search_type=='cnic'){
                    $query->whereHas('applicants', function($q) use ($request) 
                    { $q->where('cnic', $request->search); 
                    });
                }elseif($request->search_type=='name'){
                    $query->whereHas('applicants', function($q) use ($request) 
                    { $q->where('name','like', "%".$request->search."%"); 
                    });
                }elseif($request->search_type=='application_no'){
                    $query->where('id', $request->search);
                }
                
            }
            if (!empty($request->application_type_id)) { 
                $query->where('application_type_id', $request->application_type_id); 
            } 
            if (!empty($request->application_status_id)) { 
                $query->where('application_status_id', $request->application_status_id); 
            }
            if (!empty($request->from) && !empty($request->to)) { 
                $query->whereBetween('created_at', [$request->from, $request->to]); 
            } elseif (!empty($request->from)) { 
                $query->where('created_at', '>=', $request->from); 
            } elseif (!empty($request->to)) { 
                $query->where('created_at', '<=', $request->to); 
            } 
            $query->orderBy('id', 'desc');
            $user_apps = $query->paginate(10);
        }
        $app_statuses = application_statuses::all();
        return view('dashboard', compact('user_apps', 'app_statuses'));

    }
    public function editorgverification($id){
        $user = Auth::user();
        $applicants = application::where('id', $id)
                                    ->where('user_id', $user->id)
                                    ->with(['applicants'=>function($query){
                                        $query->select('id', 'cnic', 'name', 'fathername', 'domicile_number', 'issuance_date');
                                    }])->get();
        if ($applicants->isNotEmpty()){
            return view('domicile_verification.editorgverification', compact('applicants'));
        }  else{
            return redirect()->back();
        }
        
    }
    public function editverification($id){
        $user = Auth::user();
        $applicants = application::where('id', $id)
                                    ->where('user_id', $user->id)
                                    ->with(['applicants'=>function($query){
                                        $query->select('id', 'cnic', 'name', 'fathername', 'domicile_number', 'issuance_date');
                                    }])->get();
        
        if ($applicants->isNotEmpty()){
            return view('domicile_verification.editverification', compact('applicants'));
        }  else{
            return redirect()->back();
        }
        
    }

    public function updateverificationapp(Request $request, $id){
        $user = Auth::user();
        if ($request->cnic == $user->cnic or strtolower($request->fathername) == strtolower($user->name) ){
            // applicant himself or his childern are allowed to procced further
        }else{
            return redirect()->back()->withErrors(['error'=>'For cnic or father name update in this application, first update your profile and then update modification here.'])->withInput();
        } 
        $request->validate([
            'cnic'=>'required|numeric|digits:13',
            'name'=>'required|string|max:45',
            'fathername'=>'required|string|max:45',  
            'domicile_number'=>'required|string|max:45',
            'issuance_date'=>'required|date',
        ]);
        
        $user = Auth::user();
        $application = application::where('id', $id)
                                    ->where('user_id', $user->id)
                                    ->with('applicants')->first();
        if ($application){
            $application->applicants->update([
                'cnic'=>$request->cnic,
                'name'=>$request->name,
                'fathername'=>$request->fathername,
                'domicile_number'=>$request->domicile_number,
                'issuance_date'=>$request->issuance_date,
            ]);
        }
        if ($application->multiple_docs==1){
            if ($request->hasFile('scan_file')) {
                $request->validate([
                    'scan_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                ],);
                $path = $request->file('scan_file')->store('images', 'public');
            } else {
                $path = null;
            }
            document::insert([
                'application_id'=>$application->id,
                'document_path'=>$path,
            ]);
        }
        return redirect()->route('dashboard');
    }
    public function updateorgverificationapp(Request $request, $id){
        $request->validate([ 
            'domicile_number'=>'required|string|max:45',
            'issuance_date'=>'required|date',
        ]);
        
        $user = Auth::user();
        $application = application::where('id', $id)
                                    ->where('user_id', $user->id)
                                    ->with('applicants')->first();
        if ($application){
            $application->applicants->update([
                'cnic'=>$request->cnic,
                'name'=>$request->name,
                'fathername'=>$request->fathername,
                'domicile_number'=>$request->domicile_number,
                'issuance_date'=>$request->issuance_date,
            ]);
        }
        if ($application->multiple_docs==1){
            if ($request->hasFile('scan_file')) {
                $request->validate([
                    'scan_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                ],);
                $path = $request->file('scan_file')->store('images', 'public');
            } else {
                $path = null;
            }
            document::insert([
                'application_id'=>$application->id,
                'document_path'=>$path,
            ]);
        }
        // $user_apps = application::with('appication_statuses')
        //                             ->with('documents')
        //                             ->with('application_types')
        //                             ->where('user_id', '=', $user->id)->get();
        return redirect()->route('dashboard');
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
    public function create_text_file($content){
        //createing verification certificate
        $filename = "example.txt";

        // Open the file in write mode ("w" will overwrite the file if it exists)
        $file = fopen($filename, "w");

        // Check if the file was successfully opened
        if ($file) {
            
            // Write content to the file
            fwrite($file, $content);

            // Close the file
            fclose($file);
        }
    }
    public function updatestatus(Request $request, $id){
        
        $request->validate([
            'status_id'=>'required|numeric|between:1,7',
            'remarks'=>'string|max:100',
        ]);
        $user = Auth::user();
        //obtain application type
        $app_type = application::findorfail($id);
        $app_type = $app_type->application_type_id;
        // 1 is citizen means both operator and admin can update status
        if ($user->role!=1){
            // 2 means approve application and user is not admin
            if($request->status_id==4 and $user->role!=2 or $request->status_id==2 and $user->role!=2){
                abort(401, 'You are not authorized');
            }

            $application = application::findorfail($id);
            $application->application_status_id = $request->status_id;
            $application->save();
            
            conversation::create([
                'application_id'=>$id,
                'sender_id'=>$user->id,
                'receiver_id'=>$application->user_id,
                'chat'=>$request->remarks,
            ]);
            $content = $request->status_id ;
            $this->create_text_file($content);
            if($request->status_id==4 and $app_type==2){
                $application = application::with(['applicants'=>function($query){
                                $query->select('id', 'cnic', 'name', 'fathername', 'domicile_number', 'issuance_date');
                                }])
                                ->with(['users'=>function($query){
                                    $query->select('id', 'user_type_id', 'name', 'fathername');
                                    }])
                                ->where('id', $id)->get();
                
                $this->gen_pdf($id, $application);
            } else if ($request->status_id==2 and $app_type==1){
                
                $application = application::with(['applicants'=>function($query){
                    $query->select('id', 'cnic', 'name', 'fathername', 'date_of_birth', 
                    'date_of_arrival', 'temporaryAddress', 'permanentAddress', 'marital_status_id', 'occupation_id')
                    ->with('childerns', 'marital_status', 'occupations');
                    }])
                    ->where('id', $id)->get();
                                
                $this->gen_form_p($id, $application);
            }
            //if we need another doument than applicant is allowed to submit another image
            if($request->status_id==6){
                DB::table('applications')
                    ->where('id',$id)
                    ->update(['multiple_docs'=>'1']);
            }   
        }
        return redirect()->route('chat', $id);
    }
    public function createnew(){
        $user = Auth::user();
        return view('newdomicile.createnew', compact('user'));
    }
    
    public function storenew(Request $request){
        
        $user = Auth::user();
        if ($request->cnic == $user->cnic or strtolower($request->fathername) == strtolower($user->name) ){
            // applicant himself or his childern are allowed to procced further
        }else{
            return redirect()->back()->withErrors(['error'=>'You can only apply for your self and your childerns'])->withInput();
        } 
        $request->validate([
            'cnic'=>'required|numeric|digits:13',
            'name'=>'required|string|max:45',
            'fathername'=>'required|string|max:45',
            'date_of_birth' => 'required|date|before_or_equal:today',
            'gender_id'=>'required|numeric|min:1|max:3',
            'place_of_birth'=>'required|max:45',
            'marital_status_id'=>'required|numeric|min:1|max:5',
            'religion'=>'required|max:45|string',
            'qualification_id'=>'numeric',
            'occupation_id'=>'numeric',
            'temporaryAddress_province_id'=>'required|numeric',
            'temporaryAddress_tehsil_id'=>'required|numeric',
            'temporaryAddress_district_id'=>'required|numeric',
            'temporaryAddress'=>'required|max:100',
            'permanentAddress_province_id'=>'required|numeric',
            'permanentAddress_tehsil_id'=>'required|numeric',
            'permanentAddress_district_id'=>'required|numeric',
            'permanentAddress'=>'required|max:100',
            'date_of_arrival'=>'required|date|before_or_equal:today',
            'contact'=>'required|max:11',
        ]);

        $applicant = applicants::firstOrNew(['cnic' => $request->cnic]); 
        // Update applicant details 
        $applicant->cnic = $request->cnic;
        $applicant->name = $request->name; 
        $applicant->fathername = $request->fathername; 
        $applicant->date_of_birth = $request->date_of_birth; 
        $applicant->gender_id = $request->gender_id; 
        
        $applicant->place_of_birth = $request->place_of_birth; 
        $applicant->marital_status_id = $request->marital_status_id; 
        $applicant->religion = $request->religion; 
        $applicant->qualification_id = $request->qualification_id; 
        $applicant->occupation_id = $request->occupation_id; 
        $applicant->temporaryAddress_province_id = $request->temporaryAddress_province_id; 
        $applicant->temporaryAddress_tehsil_id = $request->temporaryAddress_tehsil_id; 
        $applicant->temporaryAddress_district_id = $request->temporaryAddress_district_id; 
        $applicant->temporaryAddress = $request->temporaryAddress; 
        $applicant->permanentAddress_province_id = $request->permanentAddress_province_id; 
        $applicant->permanentAddress_tehsil_id = $request->permanentAddress_tehsil_id; 
        $applicant->permanentAddress_district_id = $request->permanentAddress_district_id; 
        $applicant->permanentAddress = $request->permanentAddress; 
        $applicant->date_of_arrival = $request->date_of_arrival; 
        $applicant->contact = $request->contact; 
        // Save the applicant record 
        $applicant->save();
        if ($request->has('children')) { 
            $request->validate([ 
                'children.*.name' => 'required|string|max:255', 
                'children.*.cnic' => 'required|digits:13', 
                'children.*.date_of_birth' => 'required|date', 
                'children.*.gender_id' => 'required|integer', 
                // 'children.*.is_applicant' => 'boolean', 
            ]);
            foreach ($request->children as $child) { 
                childern::create([ 
                    'applicant_id'=>$applicant->id,
                    'child_name' => $child['name'], 
                    'child_cnic' => $child['cnic'], 
                    'child_dob' => $child['date_of_birth'], 
                    'child_gender_id' => $child['gender_id'], 
                    // Add other fields as needed 
                    ]);
                     
            } 
        }
        $user_apps = application::where('user_id', '=', $user->id)
                            ->whereHas('applicants', function ($query) use ($request){
                                $query->where('cnic', '=', $request->cnic)->select('cnic', 'id');
                                })
                            ->where('application_type_id', '=', '1')
                            ->get();
        
        if ($user_apps->isNotEmpty()){
            return redirect()->back()->withErrors(['error'=>'Your Application is already under procss.'])->withInput();
        }
        // validating scan file
        $request->validate([ 
            'scan_documents' => 'required|file|mimes:jpg,jpeg,png,pdf|max:4096',
        ],[
            'scan_documents.required'=>'Scaned documents are required',
        ]);
        if ($request->hasFile('scan_documents')) {
            $path = $request->file('scan_documents')->store('images', 'public');
        } else {
            $path = null;
        }
        // incase new application record creation or getting id of existing record
        
        $new_rec = application::create([
            'user_id'=>$user->id,
            'applicant_id'=>$applicant->id,
            'application_type_id'=>'1',
            'application_status_id'=>'1',
        ]);
            
        // saving scan document record
        document::insert([
            'application_id'=>$new_rec->id,
            'document_path'=>$path,
        ]);
        // we need active operator id for conversation
        $activOperator = User::where('role', '3')
                             ->where('status_id', '1')
                             ->get(['id']);
        if ($activOperator->isEmpty()){
            return redirect()->back()->withErrors(['error'=>'No Operator is active to record your messages. Please Contact System Administrator.'])->withInput();
        }
        
        conversation::create([
            'application_id'=>$new_rec->id,
            'sender_id'=>$activOperator[0]->id,
            'receiver_id'=>$user->id,
            'chat'=>'Your application for New Domicile is received.',
        ]);

        // preparing data for dashboard page
        $user_apps = application::with('application_statuses')
                                    ->with('documents')
                                    ->with('application_types')
                                    ->where('user_id', '=', $user->id)->get();
        return redirect()->route('dashboard', compact('user_apps'));

    }   
    public function applyverification(){
        return view('domicile_verification.applyverification');
    }
    public function applyorgverification(){
        return view('domicile_verification.applyorgverification');
    }
    public function submitverification(Request $request){
        // checking if a applicant is allowed for multiple documens already applied for domicile verification
        $user = Auth::user();
        if ($request->cnic == $user->cnic or strtolower($request->fathername) == strtolower($user->name) ){
            // applicant himself or his childern are allowed to procced further
        }else{
            return redirect()->back()->withErrors(['error'=>'You can only apply for your self and your childerns'])->withInput();
        } 
        
        $user_apps = application::where('user_id', '=', $user->id)
                            ->whereHas('applicants', function ($query) use ($request){
                                $query->where('cnic', '=', $request->cnic)->select('cnic', 'id');
                                })
                            ->where('application_type_id', '=', '2')
                            ->get();
        if ($user_apps->isNotEmpty()){
            return redirect()->back()->withErrors(['error'=>'Your Application is already under procss.'])->withInput();
        }
        // validating scan file
        $request->validate([
            'cnic'=>'required|numeric|digits:13',
            'name'=>'required|string|max:45',
            'fathername'=>'required|string|max:45', 
            'scan_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'domicile_number'=>'required|string|max:45',
            'issuance_date'=>'required|date',
        ],[
            'scan_file.required'=>'Domicile Image is required',
        ]);
        if ($request->hasFile('scan_file')) {
            $path = $request->file('scan_file')->store('images', 'public');
        } else {
            $path = null;
        }
        // incase new application record creation or getting id of existing record
     
        if ($user_apps->isEmpty()){
             
            $applicant_rec = applicants::create([ 
                'cnic' => $request->cnic, 
                'name' => $request->name, 
                'fathername' => $request->fathername, 
                'domicile_number' => $request->domicile_number, 
                'issuance_date' => $request->issuance_date,
            ]);
            $new_rec = application::create([
                'user_id'=>$user->id,
                'applicant_id'=>$applicant_rec->id,
                'application_type_id'=>'2',
                'application_status_id'=>'1',
            ]);
            $app_id = $new_rec->id;
        }else{
            $app_id = $user_apps[0]->id;
        }
        // saving scan document record
        document::insert([
            'application_id'=>$app_id,
            'document_path'=>$path,
        ]);
        // we need active operator id for conversation
        $activOperator = User::where('role', '3')
                             ->where('status_id', '1')
                             ->get(['id']);
        if ($activOperator->isEmpty()){
            return redirect()->back()->withErrors(['error'=>'No Operator is active to record your messages. Please Contact System Administrator.'])->withInput();
        }
        if ($user_apps->isEmpty()){
            conversation::create([
                'application_id'=>$app_id,
                'sender_id'=>$activOperator[0]->id,
                'receiver_id'=>$user->id,
                'chat'=>'Your application for verification of Domicile is received.',
            ]);
        }else{
            conversation::create([
                'application_id'=>$app_id,
                'sender_id'=>$user->id,
                'receiver_id'=>$activOperator[0]->id,
                'chat'=>'Document Submitted.',
            ]);
            
        }
        // preparing data for dashboard page
        $user_apps = application::with('application_statuses')
                                    ->with('documents')
                                    ->with('application_types')
                                    ->where('user_id', '=', $user->id)->get();
        return redirect()->route('dashboard', compact('user_apps'));
    }
    public function submitorgVerification(Request $request){
        
        $request->validate([ 
            'cnic'=>'required|string|size:13',
            'name'=>'required|string|max:255',
            'fathername'=>'required|string|max:255',
            'domicile_number'=>'required|string|max:45',
            'issuance_date'=>'required|date',
            'scan_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        $user=Auth::user();
        $cnic = $request->cnic;
        $user_apps = Application::whereHas('applicants', function ($query) use ($cnic){
                                        $query->where('cnic', '=', $cnic)->select('cnic', 'id');
                                        })->get();
        if ($user_apps->isNotEmpty()){
        return redirect()->back()->withErrors(['error'=>'An application with this cnic number already exist.'])->withInput();
        }
        
        if ($request->hasFile('scan_file')) {
            $path = $request->file('scan_file')->store('images', 'public');
        } else {
            $path = null;
        }
        // incase new application record creation or getting id of existing record
        
        $user_apps = DB::table('applications')
                            ->where('user_id', '=', '12')
                            ->get(['id']);      
        if ($user_apps->isEmpty()){
            $applicant_rec = applicants::create([
                'cnic'=>$request->cnic,
                'name'=>$request->name,
                'fathername'=>$request->fathername,
                'domicile_number'=>$request->domicile_number,
                'issuance_date'=>$request->issuance_date,
            ]);
            $new_rec = application::create([
                'user_id'=>$user->id,
                'applicant_id'=>$applicant_rec->id,
                'application_type_id'=>'2',
                'application_status_id'=>'1',
            ]);
            $app_id = $new_rec->id;
        }else{
            $app_id = $user_apps[0]->id;
        }
        // saving scan document record
        document::insert([
            'application_id'=>$app_id,
            'document_path'=>$path,
        ]);
        // we need active admin id for conversation
        $activeAdminId = User::where('role', '3')
                             ->where('status_id', '1')
                             ->get(['id']);
        if ($activeAdminId->isEmpty()){
            return redirect()->back()->withErrors(['error'=>'No Admin is active to record your messages. Please Contact System Administrator.'])->withInput();
        }
        
        if ($user_apps->isEmpty()){
            conversation::create([
                'application_id'=>$app_id,
                'sender_id'=>$activeAdminId[0]->id,
                'receiver_id'=>$user->id,
                'chat'=>'Application for verification of Domicile is Received.',
            ]);
        }else{
            conversation::create([
                'application_id'=>$app_id,
                'sender_id'=>$activeAdminId[0]->id,
                'receiver_id'=>$user->id,
                'chat'=>'Document Submitted.',
            ]);
        }
        
        // preparing data for dashboard page
        $user_apps = application::with('application_statuses')
                                    ->with('documents')
                                    ->with('applicants')
                                    ->with('application_types')
                                    ->where('user_id', '=', $user->id)->get();
        return view('dashboard', compact('user_apps'));
    }
    public function editnew($id){
        $user = Auth::user();
        $application = Application::with(['applicants.childerns'])->findOrFail($id);
        $genders = gender::all();
        $marital_statuses = marital_status::all();
        $qualifications = qualification::all();
        $occupations = occupation::all();
        $provinces = province::all();
        $tehsils = tehsil::all();
        $districts = district::all();
        // return $districts;
        return view('newdomicile.editnew', compact('user', 'application', 'genders', 'marital_statuses', 'qualifications', 'occupations', 'provinces', 'tehsils', 'districts'));
    }
    public function updatenew(Request $request, $id){
        
        $user = Auth::user();
        if ($request->cnic == $user->cnic or strtolower($request->fathername) == strtolower($user->name) ){
            // applicant himself or his childern are allowed to procced further
        }else{
            return redirect()->back()->withErrors(['error'=>'If you want to update your cnic or father name then You should update your profile first.'])->withInput();
        } 
        $request->validate([
            'cnic'=>'required|numeric|digits:13',
            'name'=>'required|string|max:45',
            'fathername'=>'required|string|max:45',
            'date_of_birth' => 'required|date|before_or_equal:today',
            'gender_id'=>'required|numeric|min:1|max:3',
            'place_of_birth'=>'required|max:45',
            'marital_status_id'=>'required|numeric|min:1|max:5',
            'religion'=>'required|max:45|string',
            'qualification_id'=>'numeric',
            'occupation_id'=>'numeric',
            'temporaryAddress_province_id'=>'required|numeric',
            'temporaryAddress_tehsil_id'=>'required|numeric',
            'temporaryAddress_district_id'=>'required|numeric',
            'temporaryAddress'=>'required|max:100',
            'permanentAddress_province_id'=>'required|numeric',
            'permanentAddress_tehsil_id'=>'required|numeric',
            'permanentAddress_district_id'=>'required|numeric',
            'permanentAddress'=>'required|max:100',
            'date_of_arrival'=>'required|date|before_or_equal:today',
            'contact'=>'required|max:11',
        ]);
        $application = application::findorfail($id);
        $applicant = applicants::findorfail($application->applicant_id); 
        // Update applicant details 
        $applicant->cnic = $request->cnic;
        $applicant->name = $request->name; 
        $applicant->fathername = $request->fathername; 
        $applicant->date_of_birth = $request->date_of_birth; 
        $applicant->gender_id = $request->gender_id; 
        
        $applicant->place_of_birth = $request->place_of_birth; 
        $applicant->marital_status_id = $request->marital_status_id; 
        $applicant->religion = $request->religion; 
        $applicant->qualification_id = $request->qualification_id; 
        $applicant->occupation_id = $request->occupation_id; 
        $applicant->temporaryAddress_province_id = $request->temporaryAddress_province_id; 
        $applicant->temporaryAddress_tehsil_id = $request->temporaryAddress_tehsil_id; 
        $applicant->temporaryAddress_district_id = $request->temporaryAddress_district_id; 
        $applicant->temporaryAddress = $request->temporaryAddress; 
        $applicant->permanentAddress_province_id = $request->permanentAddress_province_id; 
        $applicant->permanentAddress_tehsil_id = $request->permanentAddress_tehsil_id; 
        $applicant->permanentAddress_district_id = $request->permanentAddress_district_id; 
        $applicant->permanentAddress = $request->permanentAddress; 
        $applicant->date_of_arrival = $request->date_of_arrival; 
        $applicant->contact = $request->contact; 
        // Save the applicant record 
        $applicant->save();
        if ($request->has('children')) { 
            $request->validate([ 
                'children.*.name' => 'string|max:255', 
                'children.*.cnic' => 'digits:13', 
                'children.*.date_of_birth' => 'date', 
                'children.*.gender_id' => 'integer', 
                // 'children.*.is_applicant' => 'boolean', 
            ]);
        }
        //login is to check all exisitng childerns in incoming request if they found it will
        // be  updated or  not  found will be deleted.
        $childerns = childern::where('applicant_id', $applicant->id)->get();
        foreach($childerns as $existing_child){
            if ($request->has('children')){
                $found = false;
                foreach ($request->children as $child) { 
                
                    if ($child['id']==$existing_child['id']){
                        $found = true;
                        $updated_childname = $child['name'];
                        $updated_childcnic = $child['cnic'];
                        $updated_childdob = $child['date_of_birth'];
                        $updated_childgender_id = $child['gender_id'];
                        break;
                    }
                }
            }else{
                $found = false;
            }
            
            
            
            if ($found){
                childern::where('id', $existing_child['id'])
                        ->update([
                            'child_name'=>$updated_childname,
                            'child_cnic' => $updated_childcnic, 
                            'child_dob' => $updated_childdob, 
                            'child_gender_id' => $updated_childgender_id, 
                        ]);
            }else{
                print_r($existing_child['id'] . ' Needs to be deleted');
                childern::where('id', $existing_child['id'])->delete();
            }
            
        }
        //check for new childerns 
        if ($request->has('children')){
            foreach ($request->children as $child) {     
                if ($child['id']=="0"){
                    childern::create([
                        'applicant_id'=>$applicant->id,
                        'child_name'=>$child['name'],
                        'child_cnic' => $child['cnic'], 
                        'child_dob' => $child['date_of_birth'], 
                        'child_gender_id' => $child['gender_id'], 
                    ]);
                }
            }
        }
        
        
        $user_apps = application::with('application_statuses')
                                    ->with('documents')
                                    ->with('application_types')
                                    ->where('user_id', '=', $user->id)->get();
        return redirect()->route('dashboard', compact('user_apps'));

        
        $user_apps = application::where('user_id', '=', $user->id)
                            ->whereHas('applicants', function ($query) use ($request){
                                $query->where('cnic', '=', $request->cnic)->select('cnic', 'id');
                                })
                            ->where('application_type_id', '=', '1')
                            ->get();
        
        if ($user_apps->isNotEmpty()){
            return redirect()->back()->withErrors(['error'=>'Your Application is already under procss.'])->withInput();
        }
        // validating scan file
        $request->validate([ 
            'scan_documents' => 'required|file|mimes:jpg,jpeg,png,pdf|max:4096',
        ],[
            'scan_documents.required'=>'Scaned documents are required',
        ]);
        if ($request->hasFile('scan_documents')) {
            $path = $request->file('scan_documents')->store('images', 'public');
        } else {
            $path = null;
        }
        // incase new application record creation or getting id of existing record
        
        $new_rec = application::create([
            'user_id'=>$user->id,
            'applicant_id'=>$applicant->id,
            'application_type_id'=>'1',
            'application_status_id'=>'1',
        ]);
            
        // saving scan document record
        document::insert([
            'application_id'=>$new_rec->id,
            'document_path'=>$path,
        ]);
        // we need active operator id for conversation
        $activOperator = User::where('role', '3')
                             ->where('status_id', '1')
                             ->get(['id']);
        if ($activOperator->isEmpty()){
            return redirect()->back()->withErrors(['error'=>'No Operator is active to record your messages. Please Contact System Administrator.'])->withInput();
        }
        
        conversation::create([
            'application_id'=>$new_rec->id,
            'sender_id'=>$activOperator[0]->id,
            'receiver_id'=>$user->id,
            'chat'=>'Your application for New Domicile is received.',
        ]);

        // preparing data for dashboard page
        $user_apps = application::with('application_statuses')
                                    ->with('documents')
                                    ->with('application_types')
                                    ->where('user_id', '=', $user->id)->get();
        return redirect()->route('dashboard', compact('user_apps'));
    }
}   
