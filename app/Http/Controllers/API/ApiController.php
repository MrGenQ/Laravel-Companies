<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\CompaniesResource;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Validator;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class ApiController extends Controller
{
    public function companies()
    {
        return CompaniesResource::collection(Company::all());
    }
    public function company(Company $company){
        return new CompaniesResource($company);
    }
    public function category(){
        return CategoryResource::collection(Category::all());
    }
    public function addCompany(Request $request){
        $validator = Validator::make($request->all(),[
            'company'=> 'required|unique:companies|max:255',
            'code'=> 'required',
            'vat'=> 'required',
            'address'=> 'required',
            'director'=> 'required',
            'category_id'=> 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        Company::create([
            'company' =>request('company'),
            'code' =>request('code'),
            'vat' =>request('vat'),
            'address' =>request('address'),
            'director' =>request('director'),
            'category_id' =>request('category_id'),
            'description' =>request('description'),
            'logo' => '',
            'user_id'=>request('user_id'),
        ]);
        return response()
            ->json(['message'=> 'Company created succesfully']);
    }

    public function deleteCompany($id)
    {
        $company = Company::find($id);
        $company -> delete();
        return response()->json([
            'message'=>'Company Deleted'
        ]);
    }
    public function updateCompany(Company $company, Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'company'=> 'max:255',
            'code'=> 'min:3|max:10',
            'vat'=> 'min:3|max:10',
            'address'=> 'string|max:255',
            'director'=> 'string',
            'category_id'=> 'integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $company = Company::find($id);
        $company->company = $request->get('company');
        $company->code = $request->get('code');
        $company->vat= $request->get('vat');
        $company->address= $request->get('address');
        $company->director= $request->get('director');
        $company->description = $request->get('description');
        //$company->logo= $request->logo();
        $company->category_id= $request-> get('category_id');
        $company->save();

        return response()->json(['Company updated successfully']);
    }

}
