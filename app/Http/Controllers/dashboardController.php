<?php

namespace App\Http\Controllers;
use Fpdf\Fpdf;
use App\Models\applicants;
use App\Models\application;
use App\Models\conversation;
use App\Models\document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function index(){
        if (Auth::user()->role==1){
            $user_apps = application::with('application_statuses')
                                    ->with('documents')
                                    ->with('applicants')
                                    ->with(["conversations" => function($query){$query->select('id', 'application_id')->where("is_receiver_see", "0")->where('receiver_id', Auth::id());}])
                                    ->with('application_types')
                                    ->where('user_id', '=', Auth::id())->get();
        }else{
            $user_apps = application::with('application_statuses')
                                    ->with('documents')
                                    ->with('applicants')
                                    ->with(["conversations" => function($query){$query->select('id', 'application_id')->where("is_receiver_see", "0")->where('receiver_id', Auth::id());}])
                                    ->with('application_types')
                                    ->paginate(10);
        }
        return view('dashboard', compact('user_apps'));

    }
    public function gen_pdf($id, $name, $fathername, $cnic){
        $pdf = new Fpdf(); 
        $pdf->AddPage(); 
        $pdf->SetFont('Arial', 'B', 12); 
        $pdf->Cell(0, 6, 'GOVERNMENT OF PAKISTAN',0,1,'C');
        $pdf->Cell(0, 6, 'OFFICE OF THE DEPUTY COMMISSIONER',0,1,'C');
        $pdf->Cell(0, 6, 'ISLAMABAD CAPITAL TERRITORY',0,1,'C'); 
        $pdf->Cell(0, 6, '****',0,1,'C');
        
        $pdf->SetFont('Arial','', 12); 
        $pdf->Cell(50, 6, 'No.'. $id .'/Domicile/CFC',0,0,'L');
        $pdf->Cell(0, 6, 'Dated: '.\Carbon\Carbon::now()->toDateString(),0,1,'R');

        $pdf->SetFont('Arial', 'BU', 12); 
        $pdf->Cell(0, 6, 'TO WHOM IT MAY CONCERN',0,1,'C');
        $signature = public_path(). '/images/signature.jpeg';
        $pdf->Ln(8); 
        
        // Add multi-cell text 
        $pdf->SetFont('Arial','', 12); 
        $pdf->MultiCell(0, 10, '                 It is verified that Domicile Certificate issued to Mr/Mrs/Miss. '. $name .' s/d/w/o '. $fathername .' having CNIC No. '. $cnic .' is geninue and is issued from this office.'); 
        
        $pdf->Image($signature, 130, 75, 50); 
        $pdf->Ln(20);
        $pdf->SetFont('Arial','B', 12); 
        $pdf->Cell(105, 6, '',0,0);
        $pdf->Cell(0, 6, 'Assistant Commissioner (Saddar)',0,1);
        
        $pdf->Cell(125, 6, '',0,0);
        $pdf->Cell(0, 6, 'Islamabad',0,1);

        // Output the PDF directly to the browser 
        
        $pdf_path = storage_path('app\public\certificates\verification'.$id.'.pdf');
        $pdf->Output('F', $pdf_path);
    }
    public function updatestatus(Request $request, $id){
        $request->validate([
            'status_id'=>'required|numeric|between:1,4',
            'remarks'=>'string|max:100',

        ]);
        // 1 is citizen means both operator and admin can update status
        if (Auth::user()->role!=1){
            // 2 means approve application and user is not admin
            if($request->status_id==2 and Auth::user()->role!=2){
                abort(401, 'You are not authorized');
            }
            
            $application = application::findorfail($id);
            $application->application_status_id = $request->status_id;
            $application->save();
            
            
            // application::where('id', $id)
            //              ->update(['status_id', '=', $request->status_id]);
            
            conversation::create([
                'application_id'=>$id,
                'sender_id'=>Auth::id(),
                'receiver_id'=>$application->user_id,
                'chat'=>$request->remarks,
            ]);
            if($request->status_id==2){
                $application = application::with('applicants')->where('id', $id)->get();
                $this->gen_pdf($id, $application[0]->applicants->name, $application[0]->applicants->fathername, $application[0]->applicants->cnic);
            }
               
        }
        return redirect()->route('chat', $id);
    }
    public function createnew(){
        return view('createnew');
    }
    public function storenew(Request $request){

    }   
    public function applyverification(){
        return view('applyverification');
    }
    public function applyorgverification(){
        return view('applyorgverification');
    }
    public function submitverification(Request $request){
        // checking if a applicant is allowed for multiple documens already applied for domicile verification
        
        $user_apps = DB::table('applications')
                            ->where('user_id', '=', Auth::id())
                            ->where('multiple_docs', '=', '0')
                            ->get();
        
        if ($user_apps->isNotEmpty()){
            return redirect()->back()->withErrors(['error'=>'Your Application is under procss.'])->withInput();
        }
        // validating scan file
        $request->validate([ 'scan_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',]);
        if ($request->hasFile('scan_file')) {
            $path = $request->file('scan_file')->store('images', 'public');
        } else {
            $path = null;
        }
        // incase new application record creation or getting id of existing record
        $user_apps = DB::table('applications')
                            ->where('user_id', '=', Auth::id())
                            ->get(['id']);      
        if ($user_apps->isEmpty()){
            $applicant_rec = applicants::create([
                'cnic'=>Auth::user()->cnic,
                'name'=>Auth::user()->name,
                'fathername'=>Auth::user()->fathername,
            ]);
            $new_rec = application::create([
                'user_id'=>Auth::id(),
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
        $activeAdminId = User::where('role', '2')
                             ->where('status_id', '1')
                             ->get(['id']);
        if ($activeAdminId->isEmpty()){
            return redirect()->back()->withErrors(['error'=>'No Admin is active to record your messages. Please Contact System Administrator.'])->withInput();
        }
        if ($user_apps->isEmpty()){
            conversation::create([
                'application_id'=>$app_id,
                'sender_id'=>$activeAdminId[0]->id,
                'receiver_id'=>Auth::id(),
                'chat'=>'Your application for verification of Domicile is submitted.',
            ]);
        }else{
            conversation::create([
                'application_id'=>$app_id,
                'sender_id'=>$activeAdminId[0]->id,
                'receiver_id'=>Auth::id(),
                'chat'=>'Document Submitted.',
            ]);
        }
        // preparing data for dashboard page
        $user_apps = application::with('application_statuses')
                                    ->with('documents')
                                    ->with('application_types')
                                    ->where('user_id', '=', Auth::id())->get();
        return view('dashboard', compact('user_apps'));
    }
    public function submitorgVerification(Request $request){
        // checking if a applicant is allowed for multiple documens already applied for domicile verification
        
        
        // validating scan file
        $request->validate([ 
            'cnic'=>'required|string|size:13',
            'name'=>'required|string|max:255',
            'fathername'=>'required|string|max:255',
            'scan_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        
        // $user_apps = application::with('applicants')
        //                         ->whereHas('applicants', function ($query, $request){
        //                         $query->where('name', '=', $request->cnic);
        //                         })->get();
        // return $user_apps;
        // if ($user_apps->isNotEmpty()){
        // return redirect()->back()->withErrors(['error'=>'Your Application is under procss.'])->withInput();
        // }
        
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
            ]);
            $new_rec = application::create([
                'user_id'=>Auth::id(),
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
        $activeAdminId = User::where('role', '2')
                             ->where('status_id', '1')
                             ->get(['id']);
        if ($activeAdminId->isEmpty()){
            return redirect()->back()->withErrors(['error'=>'No Admin is active to record your messages. Please Contact System Administrator.'])->withInput();
        }
        
        if ($user_apps->isEmpty()){
            conversation::create([
                'application_id'=>$app_id,
                'sender_id'=>$activeAdminId[0]->id,
                'receiver_id'=>Auth::id(),
                'chat'=>'Your application for verification of Domicile is submitted.',
            ]);
        }else{
            conversation::create([
                'application_id'=>$app_id,
                'sender_id'=>$activeAdminId[0]->id,
                'receiver_id'=>Auth::id(),
                'chat'=>'Document Submitted.',
            ]);
        }
        
        // preparing data for dashboard page
        $user_apps = application::with('application_statuses')
                                    ->with('documents')
                                    ->with('applicants')
                                    ->with('application_types')
                                    ->where('user_id', '=', Auth::id())->get();
        return view('dashboard', compact('user_apps'));
    }
}   
