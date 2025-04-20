<?php

namespace App\Http\Controllers;

use App\Events\SendProfessionalMessage;
use App\Events\SendSellerMessage;
use App\Events\SendStudentMessage;
use App\Models\Chat;
use Illuminate\Http\Request;
use App\Models\Professional;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

   
 
    public function fetchMessagesFromUserToProfessional(Request $request)
    {
        $receiverId = $request->input('receiver_id');
        $sellerId = session('LoggedUserInfo');
    
        $messages = Chat::where(function($query) use ($sellerId, $receiverId) {
            $query->where('sender_id', $sellerId)
                  ->where('receiver_id', $receiverId);
        })->orWhere(function($query) use ($sellerId, $receiverId) {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', $sellerId);
        })->orderBy('created_at', 'asc')->get();
    
        return response()->json(['messages' => $messages]);
    }

    public function sendMessageFromUserToProfessional(Request $request)
    {
        // Debug authentication
        \Log::debug('Auth check', [
            'authenticated' => auth()->check(),
            'user_id' => auth()->id(),
            'session_id' => session()->getId()
        ]);
    
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Authentication required',
                'session' => session()->all()
            ], 401);
        }
    
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'receiver_id' => 'required|exists:professionals,id'
        ]);
    
        try {
            $chat = Chat::create([
                'sender_id' => auth()->id(),
                'receiver_id' => $validated['receiver_id'],
                'message' => $validated['message'],
                'seen' => false
            ]);
    
            // Broadcast the message
            event(new SendStudentMessage($chat));
    
            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully'
            ]);
    
        } catch (\Exception $e) {
            \Log::error('Message send error: '.$e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message'
            ], 500);
        }
    }




public function sendMessage(Request $request)
{
    $request->validate([
        'message' => 'required|string',
        'receiver_id' => 'required|integer|exists:users,id', // Ensure the receiver_id is a valid user id
    ]);

    $LoggedProfessionalInfo = Professional::find(session('LoggedProfessionalInfo'));
    if (!$LoggedProfessionalInfo) {
        return response()->json([
            'success' => false,
            'message' => 'You must be logged in to send a message',
        ]);
    }

    $message = new Chat();
    $message->sender_id = $LoggedProfessionalInfo->id;
    $message->receiver_id = $request->receiver_id;
    $message->message = $request->message;
    $message->save();
    broadcast(new SendProfessionalMessage($message))->toOthers();

    return response()->json([
        'success' => true,
        'message' => 'Message sent successfully',
    ]);
}
public function fetchMessages(Request $request)
{
    $receiverId = $request->input('receiver_id');
    
    // Fetch the logged-in admin using the session
    $adminId = session('LoggedProfessionalInfo');
    $LoggedProfessionalInfo = Professional::find($adminId);

    if (!$LoggedProfessionalInfo) {
        return response()->json([
            'error' => 'Professional not found. You must be logged in to access messages.'
        ], 404);
    }

    // Fetch messages between the admin and the specified seller
    $messages = Chat::where(function ($query) use ($adminId, $receiverId) {
        $query->where('sender_id', $adminId)
              ->where('receiver_id', $receiverId);
    })->orWhere(function ($query) use ($adminId, $receiverId) {
        $query->where('sender_id', $receiverId)
              ->where('receiver_id', $adminId);
    })->orderBy('created_at', 'asc')->get();

    return response()->json([
        'messages' => $messages
    ]);
}

public function fetchMessagesForStudent(Request $request)
{
    $receiverId = $request->input('receiver_id'); // the professional's ID
    $studentId = auth()->id(); // or session('LoggedUserInfo') if you don't use auth()

    if (!$studentId) {
        return response()->json([
            'success' => false,
            'message' => 'You must be logged in as a student',
        ], 401);
    }

    $messages = Chat::where(function($query) use ($studentId, $receiverId) {
        $query->where('sender_id', $studentId)
              ->where('receiver_id', $receiverId);
    })->orWhere(function($query) use ($studentId, $receiverId) {
        $query->where('sender_id', $receiverId)
              ->where('receiver_id', $studentId);
    })->orderBy('created_at', 'asc')->get();

    return response()->json([
        'success' => true,
        'messages' => $messages,
    ]);
}

}
















