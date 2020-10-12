<?php


namespace App\Http\Controllers;


use App\Imports\UserImport;
use App\Imports\UsersImport;
use App\Uuid;
use Illuminate\Http\Request;
//use Maatwebsite\Excel\Facades\Excel;
//use Excel;
use Maatwebsite\Excel\Excel;
use Rap2hpoutre\FastExcel\FastExcel;
use App\User;
class ImportController extends Controller
{

    public function import(Request $request)
    {
         if ($request->isMethod('POST')) {
             User::truncate();
             session()->regenerate();
             $path = $request->file('file')->getRealPath();
             $collections = (new FastExcel)->import($path);
             $neglected_users = 0;


             foreach ($collections as $collection) {
                 try {

                     if (Uuid::where('uuid', 'like', $collection['UID*'])->first()) {
                         User::create([
                             'first_name' => $collection['First Name'],
                             'second_name' => $collection['Second Name'],
                             'family_name' => $collection['Family Name'],
                             'uuid' => $collection['UID*']
                         ]);
                     } else {
                         $neglected_users++;
                     }


                 } catch (\Exception $E) {
                     session()->put( 'error' , 'success sheet uploaded');
                     return redirect('/');
                 }
             }
             session()->put('neglected_users' , $neglected_users);
         }
$users =  User::paginate(10);
session()->put('users' , $users);
        if (request()->ajax()) {
          return view('separated')->with('users' ,$users);

        }

        return view('welcome')->with('users' ,$users);

    }

}
