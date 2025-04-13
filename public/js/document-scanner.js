class DocumentScanner {
  constructor(options) {
    this.apiBaseUrl = options.apiBaseUrl
    this.onScanComplete = options.onScanComplete
    this.modal = null
    this.scannerList = []
    this.selectedScanner = null
    this.dpi = 300
    this.mode = "color"

    this.initialize()
  }

  async initialize() {
    await this.fetchScanners()
  }

  async fetchScanners() {
    try {
      const response = await fetch(`${this.apiBaseUrl}/scanners`)
      const data = await response.json()
      this.scannerList = data.scanners
      this.webcamAvailable = data.webcam_available
    } catch (error) {
      console.error("Error fetching scanners:", error)
      this.scannerList = []
      this.webcamAvailable = false
    }
  }

  showModal() {
    if (!this.modal) {
      this.createModal()
    }
    this.modal.classList.remove("hidden")
  }

  closeModal() {
    if (this.modal) {
      this.modal.classList.add("hidden")
    }
  }

  createModal() {
    this.modal = document.createElement("div")
    this.modal.classList.add(
      "fixed",
      "top-0",
      "left-0",
      "w-full",
      "h-full",
      "bg-gray-500",
      "bg-opacity-75",
      "flex",
      "items-center",
      "justify-center",
      "hidden",
    )
    this.modal.innerHTML = `
            <div class="bg-white rounded shadow-lg p-8 max-w-md w-full">
                <h2 class="text-2xl font-bold mb-4">Scan Document</h2>
                <div id="scannerOptions">
                    ${
                      this.scannerList.length > 0
                        ? `
                        <label for="scannerSelect" class="block text-gray-700 text-sm font-bold mb-2">Select Scanner:</label>
                        <select id="scannerSelect" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4">
                            ${this.scannerList.map((scanner, index) => `<option value="${scanner.name}" ${index === 0 ? "selected" : ""}>${scanner.name} (${scanner.vendor} ${scanner.model})</option>`).join("")}
                            ${this.webcamAvailable ? '<option value="webcam">Webcam</option>' : ""}
                        </select>
                    `
                        : "<p>No scanners found. Using webcam.</p>"
                    }
                    <div class="mb-4">
                        <label for="dpiSelect" class="block text-gray-700 text-sm font-bold mb-2">DPI:</label>
                        <select id="dpiSelect" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="150">150</option>
                            <option value="300" selected>300</option>
                            <option value="600">600</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="modeSelect" class="block text-gray-700 text-sm font-bold mb-2">Mode:</label>
                        <select id="modeSelect" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="color" selected>Color</option>
                            <option value="grayscale">Grayscale</option>
                            <option value="lineart">Lineart</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button id="scanButton" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">Scan</button>
                    <button id="cancelButton" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancel</button>
                </div>
            </div>
        `

    document.body.appendChild(this.modal)

    const scanButton = this.modal.querySelector("#scanButton")
    const cancelButton = this.modal.querySelector("#cancelButton")
    const scannerSelect = this.modal.querySelector("#scannerSelect")
    const dpiSelect = this.modal.querySelector("#dpiSelect")
    const modeSelect = this.modal.querySelector("#modeSelect")

    scanButton.addEventListener("click", async () => {
      const useScanner = this.scannerList.length > 0
      const scannerName = scannerSelect ? scannerSelect.value : null
      const dpi = dpiSelect ? Number.parseInt(dpiSelect.value) : 300
      const mode = modeSelect ? modeSelect.value : "color"

      try {
        const response = await fetch(`${this.apiBaseUrl}/scan`, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            use_scanner: useScanner,
            scanner_name: scannerName === "webcam" ? null : scannerName,
            dpi: dpi,
            mode: mode,
          }),
        })

        const data = await response.json()

        if (data.success) {
          this.onScanComplete(data)
          this.closeModal()
        } else {
          alert(`Scan failed: ${data.error}`)
        }
      } catch (error) {
        console.error("Error during scan:", error)
        alert("Scan failed: " + error)
      }
    })

    cancelButton.addEventListener("click", () => {
      this.closeModal()
    })
  }
}

export default DocumentScanner
