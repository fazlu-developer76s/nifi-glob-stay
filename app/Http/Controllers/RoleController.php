<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Permission;
use DB;
use App\Models\Roles;
use Faker\Provider\ar_EG\Company;
use Illuminate\Http\Request;
use PDO;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Google\Client as GoogleClient;

class RoleController extends Controller
{

    public function index()
    {
        $title = 'Roles';
        $get_role = Roles::where('status', '!=', 3)->where('id', '!=', 1)->orderBy('id', 'desc')->get();
        return view('roles.index', compact('title', 'get_role'));
    }
    public function test()
    {
        $title = 'Roles';
        $get_role = Roles::where('status', '!=', 3)->where('id', '!=', 1)->orderBy('id', 'desc')->get();
        return view('roles.test', compact('title', 'get_role'));
    }


    public function googleAuth(Request $request)
{
    $code = $request->query('code');

    $client = new GoogleClient();
    $client->setClientId(env('GOOGLE_CLIENT_ID'));
    $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
    $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
    $client->addScope("email");
    $client->addScope("profile");

    $token = $client->fetchAccessTokenWithAuthCode($code);

    if (isset($token['error'])) {
        return response()->json([
            'status' => false,
            'message' => $token['error_description'] ?? 'Authentication failed'
        ], 400);
    }

    $client->setAccessToken($token['access_token']);
    $oauth2 = new \Google\Service\Oauth2($client);
    $googleUser = $oauth2->userinfo->get();

    $email = $googleUser->email;
    $name = $googleUser->name;

    $encryptedEmail = $email;
    $encryptedName = $name;

    $user = User::where('email', $encryptedEmail)->first();

    if (!$user) {
        $user = User::create([
            'name' => $encryptedName,
            'email' => $encryptedEmail,
        ]);
    }

    $payload = [
        'id' => $user->id,
        'email' => $user->email,
        'exp' => now()->addDays(2)->timestamp
    ];

    $jwt = JWT::encode($payload, env('TOKEN_SECRET_KEY'), 'HS256');

    return response()->json([
        'status' => true,
        'message' => 'Successfully authenticated',
        'token' => $jwt,
        'user' => $user
    ], 200);
}

    public function store_roles(Request $request)
    {

        if ($request->hidden_id) {
            $check_data = $this->check_exist_data($request->title, $request->hidden_id);
            if ($check_data) {
                return redirect()->route('roles')->with('error', 'Role already exists.');
            }
            $role = Roles::findOrFail($request->hidden_id);
            $request->validate([
                'title' => 'required',
                'status' => 'required'
            ]);

            $role->title = $request->title;
            $role->status = $request->status;
            $role->update();
            return redirect()->route('roles')->with('success', 'Role updated successfully.');
        }
        $check_data =  $this->check_exist_data($request->title, null);
        if ($check_data) {
            return redirect()->route('roles')->with('error', 'Role already exists.');
        }
        $request->validate([
            'status' => 'required',
            'title' => 'required',
        ]);
        $role = new Roles();
        $role->title = $request->title;
        $role->status = $request->status;
        $role->save();
        return redirect()->route('roles')->with('success', 'Role created successfully.');
    }

    public function edit_roles($id)
    {
        $title = 'Edit Role';
        $find_role = Roles::find($id);
        $get_role = Roles::where('status', '!=', 3)->where('id', '!=', 1)->orderBy('id', 'desc')->get();
        return view('roles.index', compact('title', 'get_role', 'find_role'));
    }

    public function destroy_roles($id)
    {

        $role = Roles::findOrFail($id);
        $role->status = 3;
        $role->update();
        return redirect()->route('roles')->with('success', 'Role deleted successfully.');
    }

    public function check_exist_data($title, $id)
    {

        if ($id != null && $title != null) {
            $check_role = Roles::where('id', '!=', $id)->where('title', $title)->where('status', '!=', 3)->first();
            if ($check_role) {
                return true;
            }
        } else {
            $check_role = Roles::where('title', $title)->where('status', '!=', 3)->first();
            if ($check_role) {
                return true;
            }
        }
    }

    public function permission($id)
{
    $title = 'Permission';
    $getallpermission = array();
    $permission_category = DB::table('permission_category')->where('status', 1)->get();

    foreach ($permission_category as $category) {
        $category->permission = Permission::where('status', 1)
            ->where('per_cate_id', $category->id)
            ->get()
            ->map(function ($permission) use ($id) {
                $fetch_status = DB::table('role_permission')
                    ->where('permission_id', $permission->id)
                    ->where('role_id', $id)
                    ->first();
                $permission->permission_status = $fetch_status; // Set status here
                return $permission;
            });

        $getallpermission[] = $category; // Build the result here
    }
    $getrole = Roles::find($id);
    return view('roles.permission', compact('title', 'getallpermission', 'getrole'));
}


public function update_permission(Request $request)
{
    $roleId = $request->role_id;

    // Ensure the role exists
    $existingPermissions = DB::table('role_permission')
        ->where('role_id', $roleId)
        ->get();

    if ($existingPermissions->isEmpty()) {
        // Insert all permissions with default status
        foreach ($request->hidden_id as $permissionId) {
            DB::table('role_permission')->insert([
                'role_id' => $roleId,
                'permission_id' => $permissionId,
                'permission_status' => 2, // Default status
            ]);
        }
    } else {
        // Reset permission statuses for the role
        DB::table('role_permission')
            ->where('role_id', $roleId)
            ->update(['permission_status' => 2]);
    }

    // Update selected permissions
    if ($request->has('permission')) {
        foreach ($request->permission as $permissionId) {
            DB::table('role_permission')
                ->where('role_id', $roleId)
                ->where('permission_id', $permissionId)
                ->update(['permission_status' => 1]);
        }
    }

    return redirect()->route('roles')->with('success', 'Permissions updated successfully.');
}


    public function change_status(Request $request)
    {
        $table_name = $request->table_name;
        $id = $request->id;
        $status = $request->status;

        $change_status = DB::table($table_name)->where('id', $id)->update(['status' => $status, 'updated_at' => date('Y-m-d H:i:s')]);

        if ($change_status) {
            return response()->json(['status' => 'status changed successfully']);
        } else {
            return response()->json(['status' => false]);
        }
    }
    public function change_status_property(Request $request)
    {
        $table_name = $request->table_name;
        $id = $request->id;
        $status = $request->status;
        $change_status = DB::table($table_name)->where('id', $id)->update(['is_property_verified' => $status, 'updated_at' => date('Y-m-d H:i:s')]);

        if ($change_status) {
            return response()->json(['status' => 'status changed successfully']);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function user_verified(Request $request){

        $table_name = $request->table_name;
        $id = $request->id;
        $status = $request->status;
        $change_status = DB::table($table_name)->where('id', $id)->update(['is_user_verified' => $status, 'updated_at' => date('Y-m-d H:i:s')]);
        if ($change_status) {
            return response()->json(['status' => 'user verified successfully']);
        } else {
            return response()->json(['status' => false]);
        }
    }
}
