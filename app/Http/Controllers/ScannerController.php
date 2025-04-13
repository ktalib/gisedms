<?php

namespace App\Http\Controllers;

use App\Services\ScannerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ScannerController extends Controller
{
    protected $scannerService;

    /**
     * Create a new controller instance.
     *
     * @param ScannerService $scannerService
     * @return void
     */
    public function __construct(ScannerService $scannerService)
    {
        $this->scannerService = $scannerService;
    }

    /**
     * Get a list of available scanners
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getScanners()
    {
        $result = $this->scannerService->getScanners();
        return response()->json($result);
    }

    /**
     * Scan a document
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function scan(Request $request)
    {
        $options = $request->validate([
            'use_scanner' => 'boolean|nullable',
            'scanner_name' => 'string|nullable',
            'dpi' => 'integer|nullable',
            'mode' => 'string|nullable',
            'format' => 'string|nullable',
        ]);

        try {
            $result = $this->scannerService->scanDocument($options);
            return response()->json($result);
        } catch (\Exception $e) {
            Log::error('Error scanning document: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Capture from webcam
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function captureFromWebcam(Request $request)
    {
        $imageData = $request->input('image_data');
        
        if (empty($imageData)) {
            return response()->json([
                'success' => false,
                'error' => 'No image data provided',
            ], 400);
        }

        try {
            // Extract the base64 encoded image data
            list($type, $data) = explode(';', $imageData);
            list(, $data) = explode(',', $data);
            $imageData = base64_decode($data);

            // Get the image format
            list(, $format) = explode('/', $type);
            $format = ($format === 'jpeg') ? 'jpg' : $format;

            // Generate a unique filename
            $filename = 'webcam_' . time() . '.' . $format;
            $filepath = public_path('uploads/' . $filename);
            $directory = public_path('uploads');

            // Create directory if it doesn't exist
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            // Save the image
            file_put_contents($filepath, $imageData);

            // Return with full URL for easy access
            $publicUrl = asset('uploads/' . $filename);

            return response()->json([
                'success' => true,
                'filename' => $filename,
                'filepath' => 'uploads/' . $filename,
                'image_data' => $request->input('image_data'),
                'public_url' => $publicUrl
            ]);
        } catch (\Exception $e) {
            Log::error('Error capturing from webcam: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
