/**
 * Scanner Integration for Laravel
 * This script handles document scanning functionality
 */

class DocumentScanner {
  constructor(options = {}) {
    this.apiBaseUrl = options.apiBaseUrl || "/api"
    this.scanners = []
    this.selectedScanner = null
    this.useWebcam = false
    this.modalId = options.modalId || "scannerModal"
    this.onScanComplete = options.onScanComplete || (() => {})
    this.webcamStream = null

    // Create modal if it doesn't exist
    this.createModal()
  }

  createModal() {
    // Check if modal already exists
    if (document.getElementById(this.modalId)) {
      return
    }

    // Create modal HTML
    const modalHtml = `
            <div id="${this.modalId}" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
                <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
                    <div class="flex justify-between items-center border-b pb-3">
                        <h3 class="text-xl font-semibold text-gray-700">Document Scanner</h3>
                        <button id="closeScannerModal" class="text-gray-500 hover:text-gray-700">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="mt-4">
                        <div id="scannerControls" class="mb-4">
                            <div class="mb-3">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Scan Source</label>
                                <div class="flex items-center mb-2">
                                    <input type="radio" id="useScanner" name="scanSource" value="scanner" checked class="mr-2">
                                    <label for="useScanner" class="text-gray-700">Scanner</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" id="useWebcam" name="scanSource" value="webcam" class="mr-2">
                                    <label for="useWebcam" class="text-gray-700">Webcam (Fallback)</label>
                                </div>
                            </div>
                            
                            <div id="scannerSelection" class="mb-3">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="scannerSelect">Select Scanner</label>
                                <select id="scannerSelect" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="">Loading scanners...</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="paperSize">Paper Size</label>
                                <select id="paperSize" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="A4">A4</option>
                                    <option value="A3">A3</option>
                                </select>
                            </div>
                            <div class="mb-3" style="display: none;">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="scanResolution">Resolution (DPI)</label>
                                <select id="scanResolution" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="150">150 DPI</option>
                                    <option value="300" selected>300 DPI</option>
                                    <option value="600">600 DPI</option>
                                </select>
                            </div>
                            
                            <div class="mb-3" style="display: none;">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="scanMode">Mode</label>
                                <select id="scanMode" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="color" selected>Color</option>
                                    <option value="gray">Grayscale</option>
                                    <option value="lineart">Black & White</option>
                                </select>
                            </div>
                        </div>
                        
                        <div id="webcamContainer" class="mb-4 text-center hidden">
                            <video id="webcamVideo" class="max-w-full h-auto mx-auto border" autoplay playsinline></video>
                        </div>
                        
                        <div id="scanPreview" class="mb-4 text-center hidden">
                            <img id="scannedImage" class="max-w-full h-auto mx-auto border" src="/placeholder.svg" alt="Scanned document preview">
                        </div>
                        
                        <div id="scanStatus" class="mb-4 text-center hidden">
                            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900"></div>
                            <p class="mt-2 text-gray-700">Scanning in progress...</p>
                        </div>
                        
                        <div id="scanError" class="mb-4 text-center hidden">
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                                <p id="errorMessage">Error message will appear here</p>
                            </div>
                        </div>
                        
                        <div class="flex justify-end space-x-3">
                            <button id="startScanBtn" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Start Scan
                            </button>
                            <button id="captureWebcamBtn" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline hidden">
                                Capture
                            </button>
                            <button id="acceptScanBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline hidden">
                                Accept
                            </button>
                            <button id="cancelScanBtn" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `

    // Append modal to body
    const modalContainer = document.createElement("div")
    modalContainer.innerHTML = modalHtml
    document.body.appendChild(modalContainer.firstElementChild)

    // Add event listeners
    document.getElementById("closeScannerModal").addEventListener("click", () => this.closeModal())
    document.getElementById("cancelScanBtn").addEventListener("click", () => this.closeModal())
    document.getElementById("startScanBtn").addEventListener("click", () => this.startScan())
    document.getElementById("captureWebcamBtn").addEventListener("click", () => this.captureFromWebcam())
    document.getElementById("acceptScanBtn").addEventListener("click", () => this.acceptScan())

    // Radio button event listeners
    document.getElementById("useScanner").addEventListener("change", (e) => {
      this.useWebcam = !e.target.checked
      document.getElementById("scannerSelection").style.display = e.target.checked ? "block" : "none"
      document.getElementById("webcamContainer").style.display = e.target.checked ? "none" : "block"
      document.getElementById("startScanBtn").style.display = e.target.checked ? "block" : "none"
      document.getElementById("captureWebcamBtn").style.display = e.target.checked ? "none" : "block"

      if (!e.target.checked) {
        this.startWebcam()
      } else {
        this.stopWebcam()
      }
    })

    document.getElementById("useWebcam").addEventListener("change", (e) => {
      this.useWebcam = e.target.checked
      document.getElementById("scannerSelection").style.display = e.target.checked ? "none" : "block"
      document.getElementById("webcamContainer").style.display = e.target.checked ? "block" : "none"
      document.getElementById("startScanBtn").style.display = e.target.checked ? "none" : "block"
      document.getElementById("captureWebcamBtn").style.display = e.target.checked ? "block" : "none"

      if (e.target.checked) {
        this.startWebcam()
      } else {
        this.stopWebcam()
      }
    })
  }

  async fetchScanners() {
    try {
      const response = await fetch(`${this.apiBaseUrl}/scanners`)
      const data = await response.json()

      this.scanners = data.scanners || []
      const selectElement = document.getElementById("scannerSelect")

      // Clear existing options
      selectElement.innerHTML = ""

      if (this.scanners.length === 0) {
        const option = document.createElement("option")
        option.value = ""
        option.textContent = "No scanners found"
        selectElement.appendChild(option)

        // Auto-select webcam if no scanners found
        document.getElementById("useWebcam").checked = true
        document.getElementById("useScanner").checked = false
        document.getElementById("scannerSelection").style.display = "none"
        document.getElementById("webcamContainer").style.display = "block"
        document.getElementById("startScanBtn").style.display = "none"
        document.getElementById("captureWebcamBtn").style.display = "block"
        this.useWebcam = true
        this.startWebcam()
      } else {
        this.scanners.forEach((scanner) => {
          const option = document.createElement("option")
          option.value = scanner.name
          option.textContent = `${scanner.vendor} ${scanner.model}`
          selectElement.appendChild(option)
        })

        // Select first scanner by default
        this.selectedScanner = this.scanners[0].name
      }
    } catch (error) {
      console.error("Error fetching scanners:", error)
      // Auto-select webcam if error
      document.getElementById("useWebcam").checked = true
      document.getElementById("useScanner").checked = false
      document.getElementById("scannerSelection").style.display = "none"
      document.getElementById("webcamContainer").style.display = "block"
      document.getElementById("startScanBtn").style.display = "none"
      document.getElementById("captureWebcamBtn").style.display = "block"
      this.useWebcam = true
      this.startWebcam()
    }
  }

  showModal() {
    const modal = document.getElementById(this.modalId)
    modal.classList.remove("hidden")

    // Fetch available scanners
    this.fetchScanners()

    // Reset UI
    document.getElementById("scanPreview").classList.add("hidden")
    document.getElementById("scanStatus").classList.add("hidden")
    document.getElementById("scanError").classList.add("hidden")
    document.getElementById("startScanBtn").classList.remove("hidden")
    document.getElementById("acceptScanBtn").classList.add("hidden")

    // If webcam is selected, start it
    if (this.useWebcam) {
      this.startWebcam()
    }
  }

  closeModal() {
    const modal = document.getElementById(this.modalId)
    modal.classList.add("hidden")

    // Stop webcam if active
    this.stopWebcam()
  }

  async startScan() {
    // Show scanning status
    document.getElementById("scanStatus").classList.remove("hidden")
    document.getElementById("scanError").classList.add("hidden")
    document.getElementById("scanPreview").classList.add("hidden")
    document.getElementById("startScanBtn").classList.add("hidden")

    // Get scan parameters
    const scannerName = this.useWebcam ? null : document.getElementById("scannerSelect").value
    const dpi = Number.parseInt(document.getElementById("scanResolution").value)
    const mode = document.getElementById("scanMode").value

    try {
      const response = await fetch(`${this.apiBaseUrl}/scan`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
        body: JSON.stringify({
          use_scanner: !this.useWebcam,
          scanner_name: scannerName,
          dpi: dpi,
          mode: mode,
          format: "png",
        }),
      })

      const data = await response.json()

      // Hide scanning status
      document.getElementById("scanStatus").classList.add("hidden")

      if (data.success) {
        // Show preview
        document.getElementById("scanPreview").classList.remove("hidden")
        document.getElementById("scannedImage").src = data.image_data
        document.getElementById("acceptScanBtn").classList.remove("hidden")

        // Store scan data
        this.lastScanData = data
      } else {
        // Show error
        document.getElementById("scanError").classList.remove("hidden")
        document.getElementById("errorMessage").textContent = data.error || "An unknown error occurred"
        document.getElementById("startScanBtn").classList.remove("hidden")
      }
    } catch (error) {
      console.error("Error during scan:", error)
      // Show error
      document.getElementById("scanStatus").classList.add("hidden")
      document.getElementById("scanError").classList.remove("hidden")
      document.getElementById("errorMessage").textContent = "Failed to communicate with scanner service"
      document.getElementById("startScanBtn").classList.remove("hidden")
    }
  }

  async startWebcam() {
    const videoElement = document.getElementById("webcamVideo")

    try {
      const stream = await navigator.mediaDevices.getUserMedia({ video: true })
      videoElement.srcObject = stream
      this.webcamStream = stream
      document.getElementById("webcamContainer").classList.remove("hidden")
    } catch (error) {
      console.error("Error accessing webcam:", error)
      document.getElementById("scanError").classList.remove("hidden")
      document.getElementById("errorMessage").textContent = "Failed to access webcam: " + error.message
    }
  }

  stopWebcam() {
    if (this.webcamStream) {
      this.webcamStream.getTracks().forEach((track) => track.stop())
      this.webcamStream = null
      document.getElementById("webcamContainer").classList.add("hidden")
    }
  }

  captureFromWebcam() {
    const videoElement = document.getElementById("webcamVideo")

    if (!videoElement || !this.webcamStream) {
      document.getElementById("scanError").classList.remove("hidden")
      document.getElementById("errorMessage").textContent = "Webcam not available"
      return
    }

    // Create a canvas element to capture the image
    const canvas = document.createElement("canvas")
    canvas.width = videoElement.videoWidth
    canvas.height = videoElement.videoHeight
    const ctx = canvas.getContext("2d")

    // Draw the video frame to the canvas
    ctx.drawImage(videoElement, 0, 0, canvas.width, canvas.height)

    // Convert the canvas to a data URL
    const imageData = canvas.toDataURL("image/png")

    // Show preview
    document.getElementById("scanPreview").classList.remove("hidden")
    document.getElementById("scannedImage").src = imageData
    document.getElementById("acceptScanBtn").classList.remove("hidden")
    document.getElementById("captureWebcamBtn").classList.add("hidden")

    // Send the image data to the server
    this.uploadWebcamImage(imageData)
  }

  async uploadWebcamImage(imageData) {
    try {
      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content") || '';
      
      const response = await fetch("http://localhost/gisedms/webcam-capture", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify({
          image_data: imageData,
        }),
      });

      if (!response.ok) {
        throw new Error(`Server returned ${response.status}: ${response.statusText}`);
      }

      const data = await response.json();

      if (data.success) {
        // Store scan data
        this.lastScanData = data;
      } else {
        // Show error
        document.getElementById("scanError").classList.remove("hidden");
        document.getElementById("errorMessage").textContent = data.error || "An unknown error occurred";
      }
    } catch (error) {
      console.error("Error uploading webcam image:", error);
      document.getElementById("scanError").classList.remove("hidden");
      document.getElementById("errorMessage").textContent = "Failed to upload webcam image: " + error.message;
    }
  }

  acceptScan() {
    if (this.lastScanData) {
      // Call the callback with the scan data
      this.onScanComplete(this.lastScanData)

      // Close the modal
      this.closeModal()
    }
  }
}

// Import the DocumentScanner class (assuming it's in a separate file)
// import DocumentScanner from "./document-scanner.js"

// Initialize the scanner when the document is ready
document.addEventListener("DOMContentLoaded", () => {
  // Global scanner instance
  window.documentScanner = new DocumentScanner({
    apiBaseUrl: window.location.origin, // Use the current domain
    onScanComplete: (scanData) => {
      // This function will be called when a scan is accepted
      console.log("Scan completed:", scanData)

      // Create a hidden input to store the scanned image data
      let hiddenInput = document.getElementById("scannedImageData")
      if (!hiddenInput) {
        hiddenInput = document.createElement("input")
        hiddenInput.type = "hidden"
        hiddenInput.id = "scannedImageData"
        hiddenInput.name = "scanned_image"
        document.querySelector("form").appendChild(hiddenInput)
      }

      // Set the value to the base64 image data
      hiddenInput.value = scanData.image_data

      // Show a preview if there's a container for it
      const previewContainer = document.getElementById("scanPreviewContainer")
      if (previewContainer) {
        previewContainer.innerHTML = `
                    <div class="relative">
                        <img src="${scanData.image_data}" class="max-w-full h-auto border rounded" alt="Scanned document" />
                        <button type="button" class="absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 m-1" onclick="removeScan()">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                `
        previewContainer.classList.remove("hidden")
      }
    },
  })

  // Add click handler to scan button
  const scanButton = document.querySelector('button i.material-icons[style="color: #065c2b;"]').closest("button")
  scanButton.addEventListener("click", (e) => {
    e.preventDefault()
    window.documentScanner.showModal()
  })
})

// Function to remove a scan
function removeScan() {
  const hiddenInput = document.getElementById("scannedImageData")
  if (hiddenInput) {
    hiddenInput.value = ""
  }

  const previewContainer = document.getElementById("scanPreviewContainer")
  if (previewContainer) {
    previewContainer.innerHTML = ""
    previewContainer.classList.add("hidden")
  }
}
