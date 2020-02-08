<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Validator;
use App\Bookmark;
use Hash;
use Storage;

use Illuminate\Http\Request;
class ProfileController extends Controller
{

  public function update(Request $request){
    $rules = [
      'name' => 'required|string|min:3|max:191',
      'email' => 'required|email|min:3|max:191',
      'password' => 'nullable|min:6|max:191',
      'image' => 'nullable|image|max:1999'
    ];

    $request->validate($rules);

    $user = Auth::user();
    $user->name = $request->name;
    $user->email = $request->email;

    if($request->hasFile('image')){
      $image = $request->image;
      $ext = $image->getClientOriginalExtension();
      $filename = uniqid().'.'.$ext;
      $image->storeAs("public/images/{$user->image}");
      $user->image = $filename;
    }

    if($request->password){
      $user->password = Hash::make($request->password);
    }

    $user->save();
    return response()->json(['user' => auth()->user()], 200);

  }

    //create bookmarks
    public function bookmarks(Request $request){
      $validator = Validator::make($request->all(), [
          'user_id' => 'required|integer',
          'restaurant_id' => 'required|integer'
      ]);

      if ($validator->fails()) {
          return response()->json($validator->errors(), 422);
      }

      $bookmark = Bookmark::create([
          'user_id' => $request->user_id,
          'restaurant_id' => $request->restaurant_id
      ]);

      return response()->json(['message' => 'Added to bookmarks', 'data' => $bookmark], 200);
    }

    public function viewBookmarks()
    {
      $bookmarksAttributes = Bookmark::where('user_id', auth()->user()->id)->get();
      $bookmarks = $bookmarksAttributes->toArray();
      // dd($bookmarks);


      if ($bookmarks === null) {
        $statusMsg = 'Bookmark not found!';
        $statusCode = 404;
      }
      else {
        return response()->json(
          [
              'data' => $bookmarks
          ],
          200);
      }
    }


}
