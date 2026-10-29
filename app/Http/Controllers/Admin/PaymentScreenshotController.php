<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Joining;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PaymentScreenshotController extends Controller
{
    /**
     * Stream the uploaded payment proof to an authenticated admin.
     */
    public function __invoke(Joining $joining): StreamedResponse
    {
        $path = $joining->payment_screenshot;

        abort_unless($path && Storage::disk('public')->exists($path), 404);

        return Storage::disk('public')->response($path);
    }
}
