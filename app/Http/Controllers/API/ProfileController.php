<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Validator;
use App\Bookmark;

use Illuminate\Http\Request;
class ProfileController extends Controller
{

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

    public function editProfile(){

    }
}
