<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\JobMatchController;
use App\Http\Controllers\MentorController;

//razan
use App\Http\Controllers\JobController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\AlumniAuthController;

Route::get('/welcome', [PageController::class, 'home'])->name('home');

Route::get('/upload-cv', [PageController::class, 'uploadCv'])->name('uploadCv');
//Route::get('/profile', [PageController::class, 'manageProfile'])->name('profile');

//razan
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // ✅ Fixes profile.edit
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//newRazan

// Main home page route (now at root)
Route::get('/', function () {
    return view('mainhome');
})->name('mainhome');

// Student landing page (now at /welcome)
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/alumni/home', function () {
    return view('alumni.alumniHome'); // Note the dot notation for subfolders
})->name('alumni.home');


Route::middleware(['auth'])->group(function () {
    Route::get('/alumni/dashboard', [AlumniController::class, 'dashboard'])->name('alumni.dashboard');
   
});

Route::get('/register/alumni', [AlumniAuthController::class, 'showRegistrationForm'])->name('register.alumni');
Route::post('/register/alumni', [AlumniAuthController::class, 'register']);

Route::get('/register/student', [StudentAuthController::class, 'showRegistrationForm'])->name('register.student');
Route::post('/register/student', [StudentAuthController::class, 'register']);

Route::post('/login', [AuthenticatedSessionController::class, 'store']);




    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware(['auth:web']);
    
    // Add other authenticated routes here

require __DIR__.'/auth.php';





Route::get('/homepage', function () {
    return view('homepage');
});





// Route for displaying the form (GET request)
Route::get('/upload-cv', function () {
    return view('upload-cv'); // This links to the Blade file.
});

Route::post('/upload-cv', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
    ]);

    if ($validator->fails()) {
        return redirect('/upload-cv')->withErrors($validator)->withInput();
    }

    $filePath = $request->file('cv')->store('cvs');

    return redirect('/upload-cv')->with('success', 'CV uploaded successfully!');
});

Route::post('/feedback', [FeedbackController::class, 'store'])->middleware('auth');
Route::get('/feedback/{productId}', [FeedbackController::class, 'index']);
Route::get('/feedback', [FeedbackController::class, 'index']);


//razan

Route::get('/job-search', [JobController::class, 'index'])->name('job.search');
Route::get('/search/jobs', [JobController::class, 'search'])->name('search.jobs');
Route::get('/job/{job}/apply', [JobController::class, 'apply'])->name('job.apply');
Route::post('/job/{job}/apply', [JobController::class, 'submitApplication'])->name('job.submitApplication');

Route::get('/job-alerts', [AlertController::class, 'index'])->name('job.alerts');
Route::get('/applications', [ApplicationController::class, 'index'])->name('applications');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{id}/book', [EventController::class, 'bookSeat'])->name('events.book');
Route::post('/events/{id}/feedback', [EventController::class, 'submitFeedback'])->name('events.feedback');
// Submit feedback after the event
Route::get('/mentorship', [MentorshipController::class, 'index'])->name('mentorship');
Route::get('/career-insights', [CareerInsightsController::class, 'index'])->name('career.insights');
Route::get('/resources', [ResourceController::class, 'index'])->name('resources');
Route::get('/applications', function () {
    return view('coming-soon', ['message' => 'Applications page is under construction.']);
})->name('applications');

Route::middleware('auth')->group(function () {
    Route::get('/my-events', [EventController::class, 'myEvents'])->name('events.myEvents');
});

Route::get('/events/{id}/seating', [EventController::class, 'showSeating'])->name('events.seating');
Route::post('/events/{id}/reserve-seat', [EventController::class, 'reserveSeat'])->name('events.reserveSeat');
Route::post('/job-match-process', [JobMatchController::class, 'process'])->name('job.match.process');
Route::post('/job-match-process', [JobMatchController::class, 'process'])->name('job.match.process');
Route::prefix('admin')->group(function () {
    // Admin Authentication Routes
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminLoginController::class, 'login'])->name('admin.authenticate');
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('professionals/{id}/activate', [AdminController::class, 'activateProfessional'])->name('admin.professionals.activate');
        Route::post('jobs/{id}/activate', [AdminController::class, 'approveJob'])->name('admin.jobs.activate');
    });
    
});
// routes/web.php
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('auth.adminlogin');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.authenticate');
Route::get('/admin/register', [AdminRegisterController::class, 'showRegistrationForm'])->name('admin.register');
Route::post('/admin/register', [AdminRegisterController::class, 'register'])->name('admin.doRegister');
Route::get('/admin/register', 'App\Http\Controllers\Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
Route::post('/admin/register', 'App\Http\Controllers\Auth\AdminRegisterController@register')->name('admin.register.submit');
Route::post('/evaluate-job', [AdminController::class, 'evaluateJob'])->name('evaluate-job');

Route::get('/professional/events/create', [ProfessionalController::class, 'showCreateEventForm'])->name('events.create');
Route::post('/professional/events', [ProfessionalController::class, 'storeEvent'])->name('events.store');
Route::get('/admin/events/pending', [AdminController::class, 'showPendingEvents'])->name('admin.events.pending');
Route::post('/admin/events/approve/{id}', [AdminController::class, 'approveEvent'])->name('events.approve');
Route::get('/post-job', [ProfessionalController::class, 'showpostjob'])->name('professional.post_job.form');
Route::post('/professional/post-job', [ProfessionalController::class, 'postJob'])->name('professional.post_job');
Route::get('/professional/home', function () {
    return view('profHome');
})->name('home');
Route::prefix('professional')->group(function () {
   
    Route::post('register', [ProfessionalController::class, 'register'])->name('prof.register');
    Route::post('login', [ProfessionalController::class, 'login'])->name('professional.login');
    Route::get('dashboard', [ProfessionalController::class, 'dashboard'])->name('prof.dashboard');
});
Route::get('/register-professional', [ProfessionalController::class, 'showRegistrationForm'])->name('professionals.register.form');

Route::post('/evaluate_job', [AdminController::class, 'evaluateJob'])->name('evaluate_job');

Route::post('/admin/activate-student/{id}', [AdminController::class, 'activateStudent'])->name('admin.activate-student');
Route::post('/jobs/{job}/apply', [JobController::class, 'submitApplication'])->name('job.submitApplication');
Route::get('/view-resume/{id}', [JobController::class, 'viewResume'])->name('viewResume');

Route::get('/extract-resume-data/{id}', [JobController::class, 'extractResumeData']);
    // Temporary debug route - add to routes/web.php
   // Temporary test route
   Route::get('/test-resume', function() {
    $path = storage_path('app\public\resumes\Dx7vWfqo9teDjFt5uj8AYZOX04hXtNWmT7B3K116.pdf');
    return response()->file($path);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/network', [ConnectionController::class, 'index'])->name('connections.index');
    Route::post('/connect', [ConnectionController::class, 'connect'])->name('connections.connect');
    Route::post('/connections/{connection}/accept', [ConnectionController::class, 'accept'])->name('connections.accept');
    Route::post('/connections/{connection}/reject', [ConnectionController::class, 'reject'])->name('connections.reject');
});
// routes/web.php
Route::middleware(['auth:professional'])->group(function () {
    Route::get('/professional/requests', [ConnectionController::class, 'professionalRequests'])
         ->name('professional.requests');
});
// Temporary debug route - add to routes/web.php
Route::get('/debug-connections', function() {
    return [
        'sent_requests' => App\Models\Connection::where('user_id', auth()->id())->get(),
        'received_requests' => App\Models\Connection::where('connected_user_id', auth()->id())
            ->where('connected_user_type', get_class(auth()->user()))
            ->get()
    ];
})->middleware('auth');

// routes/web.php
Route::get('/fix', function() {
    \Illuminate\Foundation\Console\PackageDiscoverCommand::resolveProviders(
        require base_path('vendor/composer/installed.json')
    );
    return "Packages rediscovered";
});


Route::get('/professional/fetch-messages', [ChatController::class, 'fetchMessages'])->name('professional.fetchMessages');
Route::post('/professional/send-message', [ChatController::class, 'sendMessage'])->name('professional.sendMessage');
Route::get('/professional/chats', [ProfessionalController::class, 'chats'])->name('professional.chats');
Route::get('/fetch-messages', [ChatController::class, 'fetchMessagesFromUserToProfessional'])->name('fetch.messagesFromSellerToProfessional');
Route::post('/send-message', [ChatController::class, 'sendMessageFromUserToProfessional'])
->middleware(['auth', 'verified'])->name('send.messageFromStudentToProfessional');;

Route::get('/students/chats', [StudentsController::class, 'chats'])->name('users.chats')  ->middleware('auth') ;
Route::get('/student/fetch-messages', [ChatController::class, 'fetchMessagesForStudent'])
    ->middleware(['auth', 'verified'])
    ->name('fetch.messagesForStudent');

// In your routes/web.php
Route::post('/clear-sidebar-flag', function() {
    session()->forget('open_login_sidebar');
    return response()->json(['success' => true]);
})->name('clear.sidebar.flag')->middleware('auth:professional');

//Route::get('/professional/login',[ProfessionalController::class,'showlogin'])->name('prof.login'); 
Route::get('/professional/login', [ProfessionalController::class, 'showlogin'])->name('professional.login.form');

Route::get('/auth-check', function() {
    return response()->json([
        'authenticated' => auth()->check(),
        'user_id' => auth()->id(),
        'session_id' => session()->getId(),
        'cookie' => request()->cookie('laravel_session')
    ]);
});
// routes/web.php
Route::get('/check-auth', function() {
    return response()->json([
        'authenticated' => auth()->check(),
        'guard' => Auth::getDefaultDriver(),
        'user_id' => auth()->id(),
        'session_active' => session()->isStarted()
    ]);
});

Route::middleware(['guest:web'])->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});
Route::get('/force-logout', function() {
    auth()->logout();
    session()->flush();
    return 'Logged out and session cleared';
});
Route::get('/jobs/alert', [App\Http\Controllers\JobActivityController::class, 'index'])->name('jobs.alert');
Route::get('/job/{job}', [App\Http\Controllers\JobController::class, 'show'])->name('job.view');
Route::get('/experience/add', [MentorController::class, 'create'])->name('experience.add');
    Route::post('/experience/store', [MentorController::class, 'store'])->name('experience.store');

    // Mentorship
    Route::get('/mentorship', [MentorController::class, 'index'])->name('mentorship');
    Route::get('/mentorship/schedule/{mentor}', [MentorController::class, 'schedule'])->name('mentorship.schedule');
    Route::post('/meetings', [App\Http\Controllers\MeetingController::class, 'store'])->name('meetings.store');
    Route::get('/mentor/availability', [MentorController::class, 'availability'])->name('mentoravailability');
    Route::post('/mentor/availability', [MentorController::class, 'storeAvailability'])->name('mentor.availability.store');

    Route::get('/professional/{id}', [ProfessionalController::class, 'showProfile'])->name('professional.profile');
    Route::post('/applications/{id}/respond', [JobController::class, 'respond'])->name('applications.respond');
    Route::get('/career-suggester', function () {
        return view('career_suggester');
    })->name('career.suggester');
    