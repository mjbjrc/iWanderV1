<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use App\City;
use App\Country;
use App\States;


use Illuminate\Http\Request;
class CountryController extends Controller
{
  public function autocomplete()
  {
      return view('autocomplete');
  }

  public function search(Request $request)
  {
      $City = City::where('name','LIKE',$request->search.'%')->get();

      return response()->json($City);
  }


  public function index()
    {
      $keyword = 'ma';
      $City = States::where('name','LIKE','$'. $keyword .'%')
                ->orWhereHas('country', function($q) use ($keyword) {
                  return $q->where('name', 'LIKE', '%' . $keyword . '%');
                })
                ->where('city', function($q) use ($keyword) {
                  return $q->where('name', 'LIKE', '%' . $keyword . '%');
                })
                ->get();
      // $City = City::where('name','manila')->with('Country')->get();
      dd($City);

      // $City = States::where('id','12')->get();
      $v = $City->City()->get();
      // $Country = Country::where('name', 'manila')->get();

        // $City = City::where('name','Paris')->get();
        dd($v);
        return response()->json(
          [
              'status' => 'success',
              'data' => $Country
          ],
          200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shortname' => 'required|string|max:50',
            'name' => 'required|string|max:5',
            'phonecode' => 'required|integer|min:7,max:10'
        ]);

        if ($validator->fails()) {
          return response()->json(
            [
              'status' => 'Error: see errors',
              'errors' => $validator->errors()
            ],
            422);
        }

        $country = new Country();
        $country->shortname = $request->input('shortname');
        $country->name = $request->input('name');
        $country->phonecode = $request->input('phonecode');
        $country->save();

        return response()->json(
          [
              'status' => 'success',
              'data' => $country
          ],
          200
        );

    }

    public function show($id)
    {
        $country = Country::find($id);

        if ($country === null) {
          $statusMsg = 'Country not found!';
          $statusCode = 404;
        }
        else {
          $country->load('name');
          $statusMsg = 'success';
          $statusCode = 200;
        }

        return response()->json(
          [
              'status' => $statusMsg,
              'data' => $country
          ],
          $statusCode);
    }



    public function destroy(Request $request, $id)
    {
        $country = Country::find($id);

        if ($country === null) {
          $statusMsg = 'Course not found!';
          $statusCode = 404;
        }
        elseif ($country->count() == 0) {
          $country->delete();
          $statusMsg = "Country: {$id} deleted";
          $statusCode = 200;
        }
        else {
          $statusMsg = "Country: {$id} NOT deleted!";
          $statusCode = 422;
        }

        return response()->json(
          [
              'status' => $statusMsg,
              'data' => null
          ],
          $statusCode);
    }
}
