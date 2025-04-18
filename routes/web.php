    <?php

    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\HomepageController;
    use App\Http\Controllers\AdminController;
    use Illuminate\Support\Facades\Route;

    // Frontend homepage, must be authenticated


    // Dashboard (optional) still behind auth and email verification
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // Profile management behind auth
    Route::middleware('auth')->group(function () {
        Route::get('/', [HomepageController::class, 'index'])
        ->middleware(['auth', 'verified'])
        ->name('home');

        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
        
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
