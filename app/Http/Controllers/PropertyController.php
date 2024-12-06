<?php

namespace App\Http\Controllers;

use App\Models\CategoriesModal;
use App\Models\Facilities;
use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Global_helper as Helper;

class PropertyController extends Controller
{
    public function index()
    {
        $title = "Property List";
        $get_property = DB::table('properties as a')->join('categories as b', 'a.category_id', '=', 'b.id')->select('a.*', 'b.title as category_name')->where('a.status', '!=', '3')->where('b.status', 1)->orderBy('a.id','desc')->get();
        $properties = array();
        foreach ($get_property as $property) {
            $property->images = DB::table('properties_images')->where('property_id', $property->id)->where('status', 1)->get();
            $property->facilities = DB::table('add_facilities_propery as a')->join('facilities as b', 'a.facilities_id', '=', 'b.id')->select('a.*', 'b.title as facility_name')
                ->where('a.status', '1')->where('a.property_id', $property->id)->where('b.status', 1)->get();
            $properties[] = $property;
        }
        $allproperty = $properties;
        return view('property.index', compact('title', 'allproperty'));
    }

    public function create(Request $request){
        if ($request->method() == 'POST') {
            $validatedData = $request->validate([
                'category_id' => 'required',
                'hotel_name' => 'required|string|max:255',
                'hotel_rate' => 'required|integer',
                'hotel_address' => 'nullable|string',
                'hotel_description' => 'nullable|string',
                'hotel_map_link' => 'nullable|string',
                'state' => 'required|string',
                'place' => 'required|string',
                'price' => 'required|string',
                'booking_days' => 'nullable|string',
                'distance' => 'nullable|string',
                'location' => 'nullable|string',
                'room_type' => 'nullable|string',
                'room_size' => 'nullable|string',
                'hotel_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);
            // $checkData = Property::where('hotel_name', $request->hotel_name)->first();
            // if ($checkData) {
            //     return redirect()->route('property.create')->with('error', 'Property with this name already exists.');
            // }
            $hotel = new Property();
            $hotel->user_id = Auth::user()->id;
            $hotel->category_id = $request->category_id;
            $hotel->hotel_name = $request->hotel_name;
            $hotel->hotel_rate = $request->hotel_rate;
            $hotel->hotel_address = $request->hotel_address;
            $hotel->hotel_description = $request->hotel_description;
            $hotel->hotel_map_link = $request->hotel_map_link;
            $hotel->state = $request->state;
            $hotel->place = $request->place;
            $hotel->price = $request->price;
            $hotel->booking_days = $request->booking_days;
            $hotel->distance = $request->distance;
            $hotel->location = $request->location;
            $hotel->room_type = $request->room_type;
            $hotel->room_size = $request->room_size;
            if(Auth::user()->role_id == 1){

            $hotel->is_property_verified = 1;
            }else{
            $hotel->is_property_verified = 2;
            }
            if ($request->hasFile('hotel_images')) {
                $images = [];
                foreach ($request->file('hotel_images') as $image) {
                    $filePath = $image->store('hotel_images', 'public');
                    $images[] = $filePath;
                }
                // $hotel->hotel_images = json_encode($images);
            }else{
                $images = array();
            }
            $hotel->save();
            $hotel->hotel_url = str_replace(' ', '-', strtolower($hotel->hotel_name)) . $hotel->id;
            $hotel->save();
            foreach ($images as $image) {
                DB::table('properties_images')->insert(['property_id' => $hotel->id,  'image' => $image]);
            }
            $filteredArray = array_filter($request->number, function ($value) {
                return !is_null($value);
            });
            $n=0;
            foreach ($filteredArray as $key => $value) {
                if (!empty($value)) {
                    $facilityId = $request->facilities[$n] ?? null;
                    if ($facilityId) {
                        DB::table('add_facilities_propery')->insert([
                            'property_id' => $hotel->id,
                            'facilities_id' => $facilityId,
                            'value' => $value,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
                $n++;
            }
            return redirect()->route('property')->with('success', 'Property Added Successfully');
        }
        $title = "Create Property";
        $get_category = CategoriesModal::where('status', 1)->get();
        $get_facilities = Facilities::where('status', 1)->get();
        return view('property.create', compact('title', 'get_category', 'get_facilities'));
    }



    public function edit($id)
    {
        if(!$id){
            return redirect()->route('property');
        }
        $title = "Edit Property";
        $prop = DB::table('properties as a')->join('categories as b', 'a.category_id', '=', 'b.id')->select('a.*', 'b.title as category_name')->where('a.status', '!=', '3')->where('b.status', 1)->where('a.id', $id)->get();
        $properties = array();
        foreach ($prop as $property) {
            $property->images = DB::table('properties_images')->where('property_id', $property->id)->where('status', 1)->get();
            $property->facilities = DB::table('add_facilities_propery as a')->join('facilities as b', 'a.facilities_id', '=', 'b.id')->select('a.*', 'b.title as facility_name')
                ->where('a.status', '1')->where('a.property_id', $property->id)->where('b.status', 1)->get();
            $properties[] = $property;
        }
        $hotel = $properties[0];
        $get_category = CategoriesModal::where('status', 1)->get();
        $get_facilities = array();
        $facilitiestable = Facilities::where('status', 1)->get();
        foreach ($facilitiestable as $facility) {
            $get_fac_data = DB::table('add_facilities_propery')->where('property_id', $id)->where('facilities_id', $facility->id)->first();
            if ($get_fac_data) {
                $facility->selected = 1;
                $facility->value = $get_fac_data->value;
            } else {
                $facility->selected = 0;
                $facility->value = 0;
            }
            $get_facilities[] = $facility;
        }
        return view('property.create', compact('title', 'hotel', 'get_category', 'get_facilities'));
    }

    public function update(Request $request)
    {
        if ($request->method() == 'POST') {
            $validatedData = $request->validate([
                'category_id' => 'required',
                'hotel_name' => 'required|string|max:255',
                'hotel_rate' => 'required|integer',
                'hotel_address' => 'nullable|string',
                'hotel_description' => 'nullable|string',
                'hotel_map_link' => 'nullable|string',
                'state' => 'required|string',
                'place' => 'required|string',
                'price' => 'required|string',
                'booking_days' => 'nullable|string',
                'distance' => 'nullable|string',
                'location' => 'nullable|string',
                'room_type' => 'nullable|string',
                'room_size' => 'nullable|string',
                'hotel_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);
            // $checkData = Property::where('hotel_name', $request->hotel_name)->first();
            // if ($checkData) {
            //     return redirect()->route('property.create')->with('error', 'Property with this name already exists.');
            // }
            $hotel =  Property::findOrFail($request->hidden_id);
            $hotel->user_id = Auth::user()->id;
            $hotel->category_id = $request->category_id;
            $hotel->hotel_name = $request->hotel_name;
            $hotel->hotel_rate = $request->hotel_rate;
            $hotel->hotel_address = $request->hotel_address;
            $hotel->hotel_description = $request->hotel_description;
            $hotel->hotel_map_link = $request->hotel_map_link;
            $hotel->state = $request->state;
            $hotel->place = $request->place;
            $hotel->price = $request->price;
            $hotel->booking_days = $request->booking_days;
            $hotel->distance = $request->distance;
            $hotel->location = $request->location;
            $hotel->room_type = $request->room_type;
            $hotel->room_size = $request->room_size;

            if ($request->hasFile('hotel_images')) {
                $images = [];
                foreach ($request->file('hotel_images') as $image) {
                    $filePath = $image->store('hotel_images', 'public');
                    $images[] = $filePath;
                }
                // $hotel->hotel_images = json_encode($images);
            }else{
                $images = array();
            }
            $hotel->save();
            $hotel->hotel_url = str_replace(' ', '-', strtolower($hotel->hotel_name)) . $hotel->id;
            $hotel->save();
            foreach ($images as $image) {
                DB::table('properties_images')->insert(['property_id' => $hotel->id,  'image' => $image]);
            }
            $delete_all_facilities = DB::table('add_facilities_propery')->where('property_id',$hotel->id)->delete();
            $filteredArray = array_filter($request->number, function ($value) {
                return !is_null($value);
            });
            $n=0;
            foreach ($filteredArray as $key => $value) {
                if (!empty($value)) {
                    $facilityId = $request->facilities[$n] ?? null;
                    if ($facilityId) {
                        DB::table('add_facilities_propery')->insert([
                            'property_id' => $hotel->id,
                            'facilities_id' => $facilityId,
                            'value' => $value,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
                $n++;
            }
            return redirect()->route('property')->with('success', 'Property Update Successfully');
        }
    }


    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->status = 3;
        $property->update();
        return redirect()->route('property')->with('success', 'Property deleted successfully.');
    }

    public function check_exist_data($request, $id)
    {
        $query = Property::where('status', '!=', 3);
        if ($id !== null) {
            $query->where('id', '!=', $id);
        }
        $check_property = $query->where(function ($q) use ($request) {
            $q->where('title', $request->title);
        })->first();

        return $check_property;
    }

    public function delete_image(Request $request)
    {
        $image = DB::table('properties_images')->where('id', $request->id)->update(['status' => 3]);
        if ($image) {
            // if ($image->image) {
            //     Storage::disk('public')->delete($image->image);
            // }
            // $image->delete();
            echo 1;
            die;

            return response()->json(['success' => 'Image deleted successfully.']);
        } else {
            return response()->json(['error' => 'Image not found.']);
        }
    }
    public function book_create(Request $request)
    {
        // dd($request);
        if ($request->method() == 'POST') {
            $validatedData = $request->validate([
                'category_id' => 'required',
                'hotel_name' => 'required|string|max:255',
                'hotel_rate' => 'required|integer',
                'hotel_address' => 'nullable|string',
                'hotel_description' => 'nullable|string',
                'hotel_map_link' => 'nullable|string',
                'state' => 'required|string',
                'place' => 'required|string',
                'price' => 'required|string',
                'booking_days' => 'nullable|string',
                'distance' => 'nullable|string',
                'location' => 'nullable|string',
                'room_type' => 'nullable|string',
                'room_size' => 'nullable|string',
                'hotel_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);
            // $checkData = Property::where('hotel_name', $request->hotel_name)->first();
            // if ($checkData) {
            //     return redirect()->route('property.create')->with('error', 'Property with this name already exists.');
            // }
            $hotel = new Property();
            $hotel->user_id = Auth::user()->id;
            $hotel->category_id = $request->category_id;
            $hotel->hotel_name = $request->hotel_name;
            $hotel->hotel_rate = $request->hotel_rate;
            $hotel->hotel_address = $request->hotel_address;
            $hotel->hotel_description = $request->hotel_description;
            $hotel->hotel_map_link = $request->hotel_map_link;
            $hotel->state = $request->state;
            $hotel->place = $request->place;
            $hotel->price = $request->price;
            $hotel->booking_days = $request->booking_days;
            $hotel->distance = $request->distance;
            $hotel->location = $request->location;
            $hotel->room_type = $request->room_type;
            $hotel->room_size = $request->room_size;
            if(Auth::user()->role_id == 1){

            $hotel->is_property_verified = 1;
            }else{
            $hotel->is_property_verified = 2;
            }
            if ($request->hasFile('hotel_images')) {
                $images = [];
                foreach ($request->file('hotel_images') as $image) {
                    $filePath = $image->store('hotel_images', 'public');
                    $images[] = $filePath;
                }
                // $hotel->hotel_images = json_encode($images);
            }else{
                $images = array();
            }
            $hotel->save();
            $hotel->hotel_url = str_replace(' ', '-', strtolower($hotel->hotel_name)) . $hotel->id;
            $hotel->save();
            foreach ($images as $image) {

                DB::table('properties_images')->insert(['property_id' => $hotel->id,  'image' => $image]);
            }
            return redirect()->route('property')->with('success', 'Property Added Successfully');
        }
        $title = "Create Property";
        $get_category = CategoriesModal::where('status', 1)->get();
        $get_facilities = Facilities::where('status', 1)->get();
        return view('property.book_create', compact('title', 'get_category', 'get_facilities'));
    }



    public function book_edit($id)
    {
        if(!$id){
            return redirect()->route('property');
        }
        $title = "Edit Property";
        $prop = DB::table('properties as a')->join('categories as b', 'a.category_id', '=', 'b.id')->select('a.*', 'b.title as category_name')->where('a.status', '!=', '3')->where('b.status', 1)->where('a.id', $id)->get();
        $properties = array();
        foreach ($prop as $property) {
            $property->images = DB::table('properties_images')->where('property_id', $property->id)->where('status', 1)->get();
            $property->facilities = DB::table('add_facilities_propery as a')->join('facilities as b', 'a.facilities_id', '=', 'b.id')->select('a.*', 'b.title as facility_name')
                ->where('a.status', '1')->where('a.property_id', $property->id)->where('b.status', 1)->get();
            $properties[] = $property;
        }
        $hotel = $properties[0];
        $get_category = CategoriesModal::where('status', 1)->get();
        $get_facilities = array();
        $facilitiestable = Facilities::where('status', 1)->get();
        foreach ($facilitiestable as $facility) {
            $get_fac_data = DB::table('add_facilities_propery')->where('property_id', $id)->where('facilities_id', $facility->id)->first();
            if ($get_fac_data) {
                $facility->selected = 1;
                $facility->value = $get_fac_data->value;
            } else {
                $facility->selected = 0;
                $facility->value = 0;
            }
            $get_facilities[] = $facility;
        }
        return view('property.book_create', compact('title', 'hotel', 'get_category', 'get_facilities'));
    }

    public function book_update(Request $request){

        if ($request->method() == 'POST') {
            $validatedData = $request->validate([
                'category_id' => 'required',
                'hotel_name' => 'required|string|max:255',
                'hotel_rate' => 'required|integer',
                'hotel_address' => 'nullable|string',
                'hotel_description' => 'nullable|string',
                'hotel_map_link' => 'nullable|string',
                'state' => 'required|string',
                'place' => 'required|string',
                'price' => 'required|string',
                'booking_days' => 'nullable|string',
                'distance' => 'nullable|string',
                'location' => 'nullable|string',
                'room_type' => 'nullable|string',
                'room_size' => 'nullable|string',
                'hotel_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);
            // $checkData = Property::where('hotel_name', $request->hotel_name)->first();
            // if ($checkData) {
            //     return redirect()->route('property.create')->with('error', 'Property with this name already exists.');
            // }
            $hotel =  Property::findOrFail($request->hidden_id);
            $hotel->user_id = Auth::user()->id;
            $hotel->category_id = $request->category_id;
            $hotel->hotel_name = $request->hotel_name;
            $hotel->hotel_rate = $request->hotel_rate;
            $hotel->hotel_address = $request->hotel_address;
            $hotel->hotel_description = $request->hotel_description;
            $hotel->hotel_map_link = $request->hotel_map_link;
            $hotel->state = $request->state;
            $hotel->place = $request->place;
            $hotel->price = $request->price;
            $hotel->booking_days = $request->booking_days;
            $hotel->distance = $request->distance;
            $hotel->location = $request->location;
            $hotel->room_type = $request->room_type;
            $hotel->room_size = $request->room_size;

            if ($request->hasFile('hotel_images')) {
                $images = [];
                foreach ($request->file('hotel_images') as $image) {
                    $filePath = $image->store('hotel_images', 'public');
                    $images[] = $filePath;
                }
                // $hotel->hotel_images = json_encode($images);
            }else{
                $images = array();
            }
            $hotel->save();
            $hotel->hotel_url = str_replace(' ', '-', strtolower($hotel->hotel_name)) . $hotel->id;
            $hotel->save();
            foreach ($images as $image) {
                DB::table('properties_images')->insert(['property_id' => $hotel->id,  'image' => $image]);
            }
            return redirect()->route('property')->with('success', 'Property Update Successfully');
        }
    }
}
