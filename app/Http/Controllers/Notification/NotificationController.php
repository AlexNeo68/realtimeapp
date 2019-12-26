<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function __construct()
    {
        $this->middleware('JWT');
    }

    public function readnotifications() {
        return NotificationResource::collection(auth()->user()->readNotifications);
    }

    public function unreadnotifications() {
        return NotificationResource::collection(auth()->user()->unreadNotifications);
    }

    public function markasread(Request $request) {
        auth()->user()->notifications->where('id', $request->id)->markAsRead();
        return response()->json(['data' => 'success'], 201);
    }
}
