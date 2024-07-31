<?php

use App\Http\Controllers\DonationController;
use App\Http\Controllers\WhatsappController;
use App\Models\Donation;
use Inertia\Inertia;
use App\Models\Award;
use App\Models\Group;
use App\Models\CheckIn;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\WinnerController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\LuckyDrawController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return Inertia::render('Welcome');
})->name('welcome');

Route::get('/lucky-draw', [LuckyDrawController::class, 'create'])->name(
  'draws.create'
);
Route::get('/lucky-draw/winners', [LuckyDrawController::class, 'index'])->name(
  'draws.winners'
);

Route::middleware('auth', 'role:Admin|Committee')->group(function () {
  Route::get('/lucky-draw/single', [
    LuckyDrawController::class,
    'createSingle',
  ])->name('draws.createSingle');
  Route::post('/lucky-draw/single', [
    LuckyDrawController::class,
    'storeSingle',
  ])->name('draws.storeSingle');
  Route::get('/lucky-draw/multiple', [
    LuckyDrawController::class,
    'createMultiple',
  ])->name('draws.createMultiple');
  Route::post('/lucky-draw/multiple', [
    LuckyDrawController::class,
    'storeMultiple',
  ])->name('draws.storeMultiple');
});

Route::get('/dashboard', function () {
  return Inertia::render('Dashboard', [
    'checkins' => CheckIn::where('user_id', Auth::user()->id)
      ->orderBy('created_at')
      ->with('meeting')
      ->get(),
    'donations' => Donation::where('user_id', Auth::user()->id)
      ->with('uploaded_file')
      ->get(),
  ]);
})
  ->middleware(['auth', 'verified'])
  ->name('dashboard');

Route::group(
  ['middleware' => ['role_or_permission:Admin|whatsapp.view']],
  function () {
    Route::get('/whatsapp', [WhatsappController::class, 'index'])->name(
      'whatsapp'
    );
    Route::get('/whatsapp/create', [WhatsappController::class, 'create'])->name(
      'whatsapp.create'
    );
    Route::post('/whatsapp', [WhatsappController::class, 'store'])->name(
      'whatsapp.store'
    );
  }
);

Route::middleware('auth', 'role:Admin')->group(function () {
  Route::get('/contingents', [GroupController::class, 'index'])->name('groups');
  Route::get('/contingents/create', [GroupController::class, 'create'])->name(
    'groups.create'
  );
  Route::post('/contingents', [GroupController::class, 'store'])->name(
    'groups.store'
  );
  Route::get('/contingents/{group}/edit', [
    GroupController::class,
    'edit',
  ])->name('groups.edit');
  Route::patch('/contingents/{group}', [
    GroupController::class,
    'update',
  ])->name('groups.update');
  Route::delete('/contingents/{group}/delete', [
    GroupController::class,
    'destroy',
  ])->name('groups.destroy');
  Route::post('/contingents/{group}/upload', [
    GroupController::class,
    'upload',
  ])->name('groups.upload');
  Route::put('/contingents/{group}/points', [
    GroupController::class,
    'points',
  ])->name('groups.points');

  Route::get('/donations', [DonationController::class, 'index'])->name(
    'donations'
  );
  Route::get('/donations/create', [DonationController::class, 'create'])->name(
    'donations.create'
  );
  Route::post('/donations', [DonationController::class, 'store'])->name(
    'donations.store'
  );
  Route::get('/donations/{donation}/edit', [
    DonationController::class,
    'edit',
  ])->name('donations.edit');
  Route::patch('/donations/{donation}', [
    DonationController::class,
    'update',
  ])->name('donations.update');
  Route::delete('/donations/{donation}/delete', [
    DonationController::class,
    'destroy',
  ])->name('donations.destroy');
  Route::post('/donations/{donation}/upload', [
    DonationController::class,
    'upload',
  ])->name('donations.upload');

  // Route::get('/donations/{donation}/edit', [DonationController::class, 'edit'])->name('donations.edit');
  // Route::patch('/donations/{donation}', [DonationController::class, 'update'])->name('donations.update');
  // Route::delete('/donations/{donation}/delete', [DonationController::class, 'destroy'])->name('donations.destroy');
  // Route::post('/donations/{donation}/upload', [DonationController::class, 'upload'])->name('donations.upload');

  Route::get('/users', [UserController::class, 'index'])->name('users');
  Route::get('/users/create', [UserController::class, 'create'])->name(
    'users.create'
  );
  Route::post('/users', [UserController::class, 'store'])->name('users.store');
  Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name(
    'users.edit'
  );
  Route::patch('/users/{user}', [UserController::class, 'update'])->name(
    'users.update'
  );
  Route::delete('/users/{user}/delete', [
    UserController::class,
    'destroy',
  ])->name('users.destroy');
  Route::put('/users/{user}/reset', [UserController::class, 'reset'])->name(
    'users.reset'
  );
  Route::put('/users/{user}/points', [UserController::class, 'points'])->name(
    'users.points'
  );

  Route::get('/awards', [AwardController::class, 'index'])->name('awards');
  Route::get('/awards/create', [AwardController::class, 'create'])->name(
    'awards.create'
  );
  Route::post('/awards', [AwardController::class, 'store'])->name(
    'awards.store'
  );
  Route::get('/awards/{award}/edit', [AwardController::class, 'edit'])->name(
    'awards.edit'
  );
  Route::patch('/awards/{award}', [AwardController::class, 'update'])->name(
    'awards.update'
  );
  Route::delete('/awards/{award}/delete', [
    AwardController::class,
    'destroy',
  ])->name('awards.destroy');

  Route::get('/sessions', [MeetingController::class, 'index'])->name(
    'sessions'
  );
  Route::get('/sessions/create', [MeetingController::class, 'create'])->name(
    'sessions.create'
  );
  Route::post('/sessions', [MeetingController::class, 'store'])->name(
    'sessions.store'
  );
  Route::get('/sessions/{meeting}/edit', [
    MeetingController::class,
    'edit',
  ])->name('sessions.edit');
  Route::patch('/sessions/{meeting}', [
    MeetingController::class,
    'update',
  ])->name('sessions.update');
  Route::delete('/sessions/{meeting}/delete', [
    MeetingController::class,
    'destroy',
  ])->name('sessions.destroy');

  Route::get('/committees', [CommitteeController::class, 'index'])->name(
    'committees'
  );
  Route::get('/committees/create', [
    CommitteeController::class,
    'create',
  ])->name('committees.create');
  Route::post('/committees', [CommitteeController::class, 'store'])->name(
    'committees.store'
  );
  Route::get('/committees/{user}/edit', [
    CommitteeController::class,
    'edit',
  ])->name('committees.edit');
  Route::patch('/committees{user}', [
    CommitteeController::class,
    'update',
  ])->name('committees.update');
  Route::delete('/committees/{user}/delete', [
    CommitteeController::class,
    'destroy',
  ])->name('committees.destroy');

  Route::get('/winners', [WinnerController::class, 'index'])->name(
    'winners.index'
  );
  Route::get('/winners/{id}/edit', [WinnerController::class, 'edit'])->name(
    'winners.edit'
  );
  Route::patch('/winners{id}', [WinnerController::class, 'update'])->name(
    'winners.update'
  );
  Route::put('/winners{id}/claim', [WinnerController::class, 'claim'])->name(
    'winners.claim'
  );

  Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
  Route::get('/roles/create', [RoleController::class, 'create'])->name(
    'roles.create'
  );
  Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
  Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name(
    'roles.edit'
  );
});

Route::middleware('auth')->group(function () {
  Route::get('/sessions/join/{meeting:uuid}/check-in', [
    CheckInController::class,
    'create',
  ])->name('checkins.create');
  Route::post('/sessions/join/{meeting:uuid}', [
    CheckInController::class,
    'store',
  ])->name('checkins.store');
  Route::get('/sessions/join/{meeting:uuid}/show/{checkIn}', [
    CheckInController::class,
    'show',
  ])->name('checkins.show');
  Route::post('/sessions/join/{meeting:uuid}/calculate', [
    CheckInController::class,
    'calculate',
  ])->name('checkins.calculate');
});

Route::middleware('auth')->group(function () {
  Route::get('/profile/create', [ProfileController::class, 'create'])->name(
    'profile.create'
  );
  Route::post('/profile', [ProfileController::class, 'store'])->name(
    'profile.store'
  );
  Route::get('/profile', [ProfileController::class, 'edit'])->name(
    'profile.edit'
  );
  Route::patch('/profile', [ProfileController::class, 'update'])->name(
    'profile.update'
  );
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name(
    'profile.destroy'
  );
});

require __DIR__ . '/auth.php';
