<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;



class SettingController extends Controller
{
    public function __construct()
    {
        $User =   DB::table('users')->where("is_active",1)->count();
        $Product =DB::table('products')->where("is_active",1)->count();
        $Article = DB::table('articles')->where("is_active",1)->count();
        $Banner = DB::table('banners')->where("is_active",1)->count();
        $Brands = DB::table('brands')->where("is_active",1)->count();
        $Category = DB::table('categories')->where("is_active",1)->count();
        $Contacts = DB::table('contacts') ->count();
        $Vendor = DB::table('vendors')->where("is_active",1)->count();

        View::share('User', $User);
        View::share('Product', $Product);
        View::share('Article', $Article);
        View::share('Banner', $Banner);
        View::share('Brands', $Brands);
        View::share('Contacts', $Contacts);
        View::share('Category', $Category);
        View::share('Vendor', $Vendor);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = setting::paginate(10);
        return view('backend.setting.index', ['data' => $data]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = setting::all();
        return view('backend.setting.create', ['data' => $data]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'company' => 'required|max:255',
            'address' => 'required|max:255',
            'address2' => 'required|max:255',
            'phone' => 'required|max:255',
            'hotline' => 'required|max:255',
            'tax' => 'required|max:255',
            'facebook' => 'required|max:255',
            'email' => 'required|max:255',
            'introduce' => 'required|max:255',

            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            //'target' => 'required',
            //'description' => 'required',
        ],[
            'company.required' => 'B???n c???n ph???i nh???p v??o ????y',
            'address.required' => 'B???n c???n ph???i nh???p v??o ????y',
            'address2.required' => 'B???n c???n ph???i nh???p v??o ????y',
            'phone.required' => 'B???n c???n ph???i nh???p v??o ????y',
            'hotline.required' => 'B???n c???n ph???i nh???p v??o ????y',
            'tax.required' => 'B???n c???n ph???i nh???p v??o ????y',
            'facebook.required' => 'B???n c???n ph???i nh???p v??o ????y',
            'email.required' => 'B???n c???n ph???i nh???p v??o ????y',
            'introduce.required' => 'B???n c???n ph???i nh???p v??o ????y',

            'image.image' => 'File ???nh ph???i c?? d???ng jpeg,png,jpg,gif,svg',

        ]);

        $setting = new setting();
        $setting->company = $request->input('company');



        $setting->image = $request->input('image');
        if($request->hasFile('image')){
            $file = $request->file('image');
            $random = Str::random(5);
            $filename= $random.'_'.time().'_'.$file->getClientOriginalName();
            $path_upload= 'upload/setting/';
            $file->move($path_upload,$filename);
            $setting->image = $path_upload.$filename;

        }

        $setting->address = $request->input('address');
        $setting->address2 = $request->input('address2');
        $setting->phone = $request->input('phone');
        $setting->hotline = $request->input('hotline');
        $setting->tax = $request->input('tax');
        $setting->facebook = $request->input('facebook');
        $setting->email = $request->input('email');
        $setting->introduce = $request->input('introduce');



        $setting->save();
        return redirect()->route('setting.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $model = setting::findOrFail($id);
        return view('backend.setting.edit', ['model' => $model],);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $setting = setting::findOrFail($id);
        $setting->company = $request->input('company');

        // @(app_path($setting->image));


        if($request->hasFile('image'))
        {


            @unlink( public_path( $setting->image));
            $setting->image = $request->input('image');
            $file = $request->file('image');
            $random = Str::random(5);
            $filename= $random.'_'.time().'_'.$file->getClientOriginalName();
            $path_upload= 'upload/setting/';
            $file->move($path_upload,$filename);
            $setting->image = $path_upload.$filename;

        }
        $setting->address = $request->input('address');
        $setting->address2 = $request->input('address2');
        $setting->phone = $request->input('phone');
        $setting->hotline = $request->input('hotline');
        $setting->tax = $request->input('tax');
        $setting->facebook = $request->input('facebook');
        $setting->email = $request->input('email');
        $setting->introduce = $request->input('introduce');

        $setting->save();
        return redirect()->route('setting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $setting = setting::findOrFail($id);
        // x??a ???nh c??
        @unlink( public_path( $setting->image));

        setting::destroy($id);

        return response()->json([
            'status' => true,
            'msg' => 'X??a th??nh c??ng'
        ]);
    }
}
