<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ScannerService
{
    /**
     * Get a list of available scanners
     *
     * @return array
     */
    public function getScanners()
    {
        try {
            if (!extension_loaded('sane')) {
                throw new Exception('SANE extension is not loaded');
            }

            $devices = sane_get_devices();
            $scanners = [];

            foreach ($devices as $device) {
                $scanners[] = [
                    'name' => $device['name'],
                    'vendor' => $device['vendor'],
                    'model' => $device['model'],
                    'type' => $device['type'],
                ];
            }

            return [
                'success' => true,
                'scanners' => $scanners,
                'webcam_available' => $this->isWebcamAvailable(),
            ];
        } catch (Exception $e) {
            Log::error('Error getting scanners: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'scanners' => [],
                'webcam_available' => $this->isWebcamAvailable(),
            ];
        }
    }

    /**
     * Scan a document using SANE
     *
     * @param array $options
     * @return array
     */
    public function scanDocument($options = [])
    {
        $useScanner = $options['use_scanner'] ?? true;
        $scannerName = $options['scanner_name'] ?? null;
        $dpi = $options['dpi'] ?? 300;
        $mode = $options['mode'] ?? 'color';
        $format = $options['format'] ?? 'png';

        try {
            if ($useScanner) {
                return $this->scanFromScanner($scannerName, $dpi, $mode, $format);
            } else {
                return $this->captureFromWebcam($format);
            }
        } catch (Exception $e) {
            Log::error('Error scanning document: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Scan a document from a physical scanner
     *
     * @param string|null $deviceName
     * @param int $dpi
     * @param string $mode
     * @param string $format
     * @return array
     */
    protected function scanFromScanner($deviceName = null, $dpi = 300, $mode = 'color', $format = 'png')
    {
        if (!extension_loaded('sane')) {
            throw new Exception('SANE extension is not loaded');
        }

        // Initialize SANE
        sane_init();

        // Get available devices
        $devices = sane_get_devices();
        
        if (empty($devices)) {
            throw new Exception('No scanner devices found');
        }

        // Use the first device if none specified
        $deviceToUse = $deviceName;
        if (empty($deviceToUse)) {
            $deviceToUse = $devices[0]['name'];
        }

        // Open the device
        $handle = sane_open($deviceToUse);
        
        if (!$handle) {
            throw new Exception("Could not open scanner: $deviceToUse");
        }

        // Set scan parameters
        sane_set_option($handle, 'resolution', $dpi);
        sane_set_option($handle, 'mode', $mode);

        // Start the scan
        sane_start($handle);

        // Read the image data
        $image = sane_get_parameters($handle);
        $data = sane_read_image($handle);

        // Close the device
        sane_close($handle);

        // Generate a unique filename
        $filename = 'scan_' . time() . '.' . $format;
        $filepath = public_path('uploads/' . $filename);
        $directory = public_path('uploads');

        // Create directory if it doesn't exist
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        // Convert raw image data to the requested format
        $gdImage = $this->createGdImageFromSaneData($data, $image['width'], $image['height'], $image['format']);
        
        switch ($format) {
            case 'png':
                imagepng($gdImage, $filepath);
                break;
            case 'jpg':
            case 'jpeg':
                imagejpeg($gdImage, $filepath, 90);
                break;
            default:
                imagepng($gdImage, $filepath);
                break;
        }
        
        // Free the GD image resource
        imagedestroy($gdImage);

        // Read the file and convert to base64 for direct display
        $imageData = base64_encode(file_get_contents($filepath));
        $mimeType = 'image/' . ($format === 'jpg' ? 'jpeg' : $format);

        return [
            'success' => true,
            'filename' => $filename,
            'filepath' => 'uploads/' . $filename,
            'image_data' => "data:{$mimeType};base64,{$imageData}",
        ];
    }

    /**
     * Capture an image from webcam
     *
     * @param string $format
     * @return array
     */
    protected function captureFromWebcam($format = 'png')
    {
        // This is a placeholder. In a real implementation, you would need to use
        // a JavaScript-based solution to capture from the webcam, as PHP cannot
        // directly access the webcam from the server side.
        throw new Exception('Webcam capture must be implemented client-side');
    }

    /**
     * Check if webcam is available
     *
     * @return bool
     */
    protected function isWebcamAvailable()
    {
        // This is always true because webcam availability is checked client-side
        return true;
    }

    /**
     * Create a GD image from SANE raw data
     *
     * @param string $data
     * @param int $width
     * @param int $height
     * @param string $format
     * @return resource
     */
    protected function createGdImageFromSaneData($data, $width, $height, $format)
    {
        // Create a new true color image
        $image = imagecreatetruecolor($width, $height);

        // Process the raw data based on the format
        switch ($format) {
            case 'gray':
                // 8 bits per pixel grayscale
                for ($y = 0; $y < $height; $y++) {
                    for ($x = 0; $x < $width; $x++) {
                        $offset = $y * $width + $x;
                        $gray = ord($data[$offset]);
                        $color = imagecolorallocate($image, $gray, $gray, $gray);
                        imagesetpixel($image, $x, $y, $color);
                    }
                }
                break;
            
            case 'rgb':
                // 24 bits per pixel RGB
                for ($y = 0; $y < $height; $y++) {
                    for ($x = 0; $x < $width; $x++) {
                        $offset = ($y * $width + $x) * 3;
                        $r = ord($data[$offset]);
                        $g = ord($data[$offset + 1]);
                        $b = ord($data[$offset + 2]);
                        $color = imagecolorallocate($image, $r, $g, $b);
                        imagesetpixel($image, $x, $y, $color);
                    }
                }
                break;
            
            default:
                // Default to grayscale
                for ($y = 0; $y < $height; $y++) {
                    for ($x = 0; $x < $width; $x++) {
                        $offset = $y * $width + $x;
                        $gray = ord($data[$offset]);
                        $color = imagecolorallocate($image, $gray, $gray, $gray);
                        imagesetpixel($image, $x, $y, $color);
                    }
                }
                break;
        }

        return $image;
    }
}
