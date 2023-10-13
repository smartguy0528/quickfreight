<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * To Admin User Management Page
     *
     * @return view
     */
    public function toAdminUsers()
    {
        $users = User::where("role", 1)
                    ->orderBy("created_at", "desc")
                    ->get();

        return view("admin.users")
            ->with("users", $users);
    }

    /**
     * To User Add Page
     *
     * @return view
     */
    public function toAdminUserAdd()
    {
        return view("admin.user_add");
    }

    /**
     * To User Edit Page
     *
     * @return view
     */
    public function toAdminUserEdit()
    {
        return view("admin.user_edit")
            ->with("user", Auth::user());
    }

    /**
     * To User Delete Page
     *
     * @return view
     */
    public function toAdminUserDelete()
    {
        return view("admin.user_delete")
            ->with("user", Auth::user());
    }
}
