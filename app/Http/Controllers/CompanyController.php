<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

class CompanyController extends Controller
{
    //Authentification
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','showCompany']]);
    }
    public function index(Request $request){
        //dd($companies);
        $filterNames = Company::pluck('company')->toArray();
        $filter = $request->input('companyCode');
        $filterName = $request->input('companyName');
        $filterDate = $request->input('registerDate');
        if($filter!="" || $filterName!="" || $filterDate === "asc" || $filterDate === "desc"){
            $companies = Company::where(function ($query) use ($filter){
                $query->where('code', 'like', '%'.$filter.'%');
            })->when($filterName, function($query, $companies){
                return $query->where('company', 'like', '%'.$companies.'%');
            })->when($filterDate, function($query, $date){
                return $query->orderBy('created_at', $date);
            })->paginate(4);
            $companies->appends(['companyCode' =>$filter]);
        }

        else{
            $companies = Company::whereDate('created_at', Carbon::today()->toDateString())->paginate(4);
        }
        return view('pages.home', compact('filterNames'))->with('filtered',$companies);
    }
    public function addCompany(){
        return view('pages.add-company');
    }
    public function storeCompany(Request $request){

        $validated = $request->validate([
            'company'=> 'required|unique:companies|max:255',
            'code'=> 'required',
            'vat'=> 'required',
            'address'=> 'required',
            'director'=> 'required',
            'companyCategory'=> 'required',
            'logo' => 'mimes:jpeg,jpg,png,gif'

        ]);
        if(request()->hasFile('logo')) {
            $path = $request->file('logo')->store('public/images');
            $fileName = str_replace('public/', '', $path);
        }
        Company::create([
            'company' =>request('company'),
            'code' =>request('code'),
            'vat' =>request('vat'),
            'address' =>request('address'),
            'director' =>request('director'),
            'companyCategory' =>request('companyCategory'),
            'description' =>request('description'),
            'logo' => $fileName,
            'user_id'=>Auth::id(),
        ]);
        return redirect('/');
    }
    public function showCompany(Company $company){
        return view('pages.show-company', compact('company'));
    }
    public function deleteCompany(Company $company){
        if(Gate::denies('delete-company', $company)){
            return view('pages.no-permission');
        }
        else {$company->delete();}
        return redirect('/');
    }
    public function updateCompany(Company $company){
        if(Gate::denies('edit-company', $company)){
            return view('pages.no-permission');
        }
        return view('pages.edit-company', compact('company'));
    }
    public function storeUpdate(Company $company, Request $request){
        if($company->logo){
            File::delete(storage_path('app/public/'.$company->logo));
        }
        if(request()->hasFile('logo')){
            $path = $request->file('logo')->store('public/images');
            $fileName = str_replace('public/','',$path);
            Company::where('id',$company->id)->update(['logo'=>$fileName]);
        }
        Company::where('id', $company->id)->update($request->only(['company', 'code', 'vat', 'address', 'director', 'companyCategory', 'description']));
        return redirect('/company/'.$company->id);
    }
    public function importCompany(){
        return view('pages.import');
    }
    public function processImport(Request $request){
        $path = $request->file('file')->storeAs('public/data', 'data.csv');
        $dataFile = Storage::get($path);

        $dataFile = explode(PHP_EOL,$dataFile);
        $file = [];
        foreach ($dataFile as $data){
            $file[] = explode(';', $data);
        }

        return view('pages.preview', compact('file'));

    }
    public function importAdd(Request $request){
        $dataFile = Storage::get('public/data/data.csv');
        $dataFile = explode(PHP_EOL,$dataFile);
        $file = [];
        foreach ($dataFile as $data){
            $file[] = explode(';', $data);
        }
        foreach ($file as $company){

            Company::create([
                'company' =>$company[0],
                'code' =>$company[1],
                'vat' =>$company[2],
                'address' =>$company[3],
                'director' =>$company[4],
                'companyCategory' =>$company[5],
                'description' =>$company[6],
                'logo' =>$company[7],
                'user_id'=>Auth::id()

            ]);

        }
        return redirect('/');
    }

}
// compact siuntimui
