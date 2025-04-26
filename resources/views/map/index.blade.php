@extends('layouts.app')
@section('page-title')
    {{ __('SECTIONAL TITLING  MODULE') }}
@endsection


@include('sectionaltitling.partials.assets.css')
@section('content')
<style>
    body {
      margin: 0;
      padding: 0;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    .leaflet-container {
      width: 100%;
      height: 100%;
    }
    .leaflet-popup-content-wrapper {
      border-radius: 8px;
      box-shadow: 0 3px 14px rgba(0,0,0,0.2);
    }
    .leaflet-popup-content {
      margin: 12px;
    }
    .custom-map-marker {
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .tab-content {
      display: none;
    }
    .tab-content.active {
      display: block;
    }
    .tab-button {
      position: relative;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 0.875rem;
      padding: 0.5rem 1rem;
      border-radius: 0.25rem;
      cursor: pointer;
      transition: background-color 0.2s;
      border: 1px solid #e5e7eb;
    }
    .tab-button.active {
      background-color: #f3f4f6;
      font-weight: 500;
      border-bottom: 2px solid #10b981;
    }
    .tab-button:hover:not(.active) {
      background-color: #f9fafb;
    }
    .tooltip {
      position: relative;
      display: inline-block;
    }
    .tooltip .tooltiptext {
      visibility: hidden;
      width: 120px;
      background-color: #333;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 5px;
      position: absolute;
      z-index: 1;
      bottom: 125%;
      left: 50%;
      margin-left: -60px;
      opacity: 0;
      transition: opacity 0.3s;
      font-size: 0.75rem;
    }
    .tooltip:hover .tooltiptext {
      visibility: visible;
      opacity: 1;
    }
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.4);
    }
    .modal-content {
      background-color: white;
      margin: 10% auto;
      padding: 20px;
      border-radius: 0.5rem;
      width: 80%;
      max-width: 800px;
    }
    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
    }
    .close:hover {
      color: black;
    }
  </style>
    <!-- Main Content -->
    <div class="flex-1 overflow-auto">
        <!-- Header -->
        @include('admin.header')
        <!-- Dashboard Content -->
        <div class="p-6">
            <div class="flex flex-col min-h-screen">
                <!-- Header -->
                <div class="bg-gradient-to-r from-white via-gray-100 to-white shadow-sm">
                  <div class="container mx-auto px-6 py-4">
                    <div class="flex justify-between items-center">
                      <div>
                         
                      </div>
                      <div class="flex items-center gap-2">
                        <a href="/sectional-titling" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                          <i data-lucide="arrow-left" class="h-4 w-4 mr-2"></i>
                          <span>Back to STM</span>
                        </a>
                        <div class="relative w-64">
                          <i data-lucide="search" class="absolute left-2.5 top-2.5 h-4 w-4 text-gray-400"></i>
                          <input type="search" placeholder="Search properties..." class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="tooltip">
                          <button class="p-2 border border-gray-300 rounded-md hover:bg-gray-50">
                            <i data-lucide="printer" class="h-4 w-4"></i>
                          </button>
                          <span class="tooltiptext">Print Map</span>
                        </div>
                        <div class="tooltip">
                          <button class="p-2 border border-gray-300 rounded-md hover:bg-gray-50">
                            <i data-lucide="download" class="h-4 w-4"></i>
                          </button>
                          <span class="tooltiptext">Export Map</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            
                <!-- Main Content -->
                <div class="flex-1 p-6 grid grid-cols-1 md:grid-cols-4 gap-6" style="min-height: calc(100vh - 200px);">
                  <!-- Left Sidebar -->
                  <div class="md:col-span-1">
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm h-full">
                      <div class="p-4 border-b">
                        <h2 class="text-lg font-medium flex items-center">
                          <i data-lucide="layers" class="h-5 w-5 mr-2 text-green-600"></i>
                          GIS Tools
                        </h2>
                      </div>
                      <div class="p-4 space-y-6">
                        <div>
                          <h3 class="text-sm font-medium mb-2">Map Layers</h3>
                          <div class="space-y-2">
                            <div class="flex items-center space-x-2">
                              <input type="checkbox" id="buildings" checked>
                              <label for="buildings" class="text-sm">Buildings</label>
                            </div>
                            <div class="flex items-center space-x-2">
                              <input type="checkbox" id="parcels" checked>
                              <label for="parcels" class="text-sm">Land Parcels</label>
                            </div>
                            <div class="flex items-center space-x-2">
                              <input type="checkbox" id="roads" checked>
                              <label for="roads" class="text-sm">Roads</label>
                            </div>
                            <div class="flex items-center space-x-2">
                              <input type="checkbox" id="waterBodies">
                              <label for="waterBodies" class="text-sm">Water Bodies</label>
                            </div>
                            <div class="flex items-center space-x-2">
                              <input type="checkbox" id="landmarks">
                              <label for="landmarks" class="text-sm">Landmarks</label>
                            </div>
                          </div>
                        </div>
            
                        <hr class="border-gray-200">
            
                        <div>
                          <h3 class="text-sm font-medium mb-2">Base Map</h3>
                          <select id="baseMapSelect" class="w-full p-2 border border-gray-300 rounded-md">
                            <option value="streets">Streets</option>
                            <option value="satellite">Satellite</option>
                            <option value="terrain">Terrain</option>
                            <option value="hybrid">Hybrid</option>
                          </select>
                        </div>
            
                        <hr class="border-gray-200">
            
                        <div>
                          <h3 class="text-sm font-medium mb-2">Property Filter</h3>
                          <select id="propertyFilter" class="w-full p-2 border border-gray-300 rounded-md">
                            <option value="all">All Properties</option>
                            <option value="commercial">Commercial</option>
                            <option value="residential">Residential</option>
                            <option value="mixed">Mixed Use</option>
                          </select>
                        </div>
            
                        <hr class="border-gray-200">
            
                        <div>
                          <h3 class="text-sm font-medium mb-2">Drawing Tools</h3>
                          <div class="flex flex-wrap gap-2">
                            <div class="tooltip">
                              <button class="p-2 border border-gray-300 rounded-md hover:bg-gray-50">
                                <i data-lucide="square" class="h-4 w-4"></i>
                              </button>
                              <span class="tooltiptext">Draw Rectangle</span>
                            </div>
                            <div class="tooltip">
                              <button class="p-2 border border-gray-300 rounded-md hover:bg-gray-50">
                                <i data-lucide="circle" class="h-4 w-4"></i>
                              </button>
                              <span class="tooltiptext">Draw Circle</span>
                            </div>
                            <div class="tooltip">
                              <button class="p-2 border border-gray-300 rounded-md hover:bg-gray-50">
                                <i data-lucide="hexagon" class="h-4 w-4"></i>
                              </button>
                              <span class="tooltiptext">Draw Polygon</span>
                            </div>
                            <div class="tooltip">
                              <button class="p-2 border border-gray-300 rounded-md hover:bg-gray-50">
                                <i data-lucide="map-pin" class="h-4 w-4"></i>
                              </button>
                              <span class="tooltiptext">Place Marker</span>
                            </div>
                            <div class="tooltip">
                              <button class="p-2 border border-gray-300 rounded-md hover:bg-gray-50">
                                <i data-lucide="pencil" class="h-4 w-4"></i>
                              </button>
                              <span class="tooltiptext">Draw Line</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            
                  <!-- Main Map Area -->
                  <div class="md:col-span-3 flex flex-col">
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm flex-1 flex flex-col">
                      <div class="p-4 border-b flex flex-row items-center justify-between">
                        <h2 class="text-lg font-medium flex items-center">
                          <i data-lucide="map" class="h-5 w-5 mr-2 text-green-600"></i>
                          Kano State Sectional Title Properties
                        </h2>
                        <div class="flex items-center gap-1">
                          <div class="tooltip">
                            <button id="zoomIn" class="p-2 border border-gray-300 rounded-md hover:bg-gray-50">
                              <i data-lucide="plus" class="h-4 w-4"></i>
                            </button>
                            <span class="tooltiptext">Zoom In</span>
                          </div>
                          <div class="tooltip">
                            <button id="zoomOut" class="p-2 border border-gray-300 rounded-md hover:bg-gray-50">
                              <i data-lucide="minus" class="h-4 w-4"></i>
                            </button>
                            <span class="tooltiptext">Zoom Out</span>
                          </div>
                          <div class="tooltip">
                            <button class="p-2 border border-gray-300 rounded-md hover:bg-gray-50">
                              <i data-lucide="maximize" class="h-4 w-4"></i>
                            </button>
                            <span class="tooltiptext">Full Screen</span>
                          </div>
                          <div class="tooltip">
                            <button id="resetView" class="p-2 border border-gray-300 rounded-md hover:bg-gray-50">
                              <i data-lucide="rotate-cw" class="h-4 w-4"></i>
                            </button>
                            <span class="tooltiptext">Reset View</span>
                          </div>
                        </div>
                      </div>
                      <div class="p-0 relative flex-1 flex flex-col">
                        <div id="mapContainer" style="width: 100%; height: 100%; min-height: 400px; position: relative; border: 1px solid #ccc; border-radius: 4px; overflow: hidden; flex: 1;">
                          <div id="mapLoadingIndicator" class="absolute inset-0 flex items-center justify-center bg-blue-50">
                            <div class="text-center">
                              <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-green-600 mx-auto mb-4"></div>
                              <p class="text-green-600">Loading map...</p>
                            </div>
                          </div>
                        </div>
                        <div class="absolute bottom-4 left-4 bg-white p-2 rounded-md shadow-md text-xs z-50">
                          <div class="font-medium">Map Legend</div>
                          <div class="flex items-center mt-1">
                            <div class="w-3 h-3 bg-cyan-700 mr-2"></div>
                            <span>Commercial Property</span>
                          </div>
                          <div class="flex items-center mt-1">
                            <div class="w-3 h-3 bg-teal-700 mr-2"></div>
                            <span>Residential Property</span>
                          </div>
                          <div class="flex items-center mt-1">
                            <div class="w-3 h-3 bg-blue-700 mr-2"></div>
                            <span>Mixed Use Property</span>
                          </div>
                        </div>
                        <div class="absolute bottom-4 right-4 bg-white p-2 rounded-md shadow-md text-xs z-50">
                          <div>Zoom Level: <span id="zoomLevel">14</span></div>
                          <div>Coordinates: 11.9959°N, 8.5164°E</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            
                <!-- Bottom Panel - Property List -->
                <div class="p-6 pt-0">
                  <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-auto" style="max-height: calc(100vh - 600px); min-height: 300px;">
                    <div class="p-4 border-b">
                      <div class="flex items-center justify-between">
                        <h2 class="text-lg font-medium flex items-center">
                          <i data-lucide="building-2" class="h-5 w-5 mr-2 text-green-600"></i>
                          Sectional Title Properties
                        </h2>
                        <div class="flex items-center gap-2">
                          <div class="relative w-64">
                            <i data-lucide="search" class="absolute left-2.5 top-2.5 h-4 w-4 text-gray-400"></i>
                            <input type="search" placeholder="Search properties..." class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md">
                          </div>
                          <button class="flex items-center px-3 py-1 text-sm border border-gray-300 rounded-md hover:bg-gray-50">
                            <i data-lucide="filter" class="h-3.5 w-3.5 mr-2"></i>
                            Filter
                          </button>
                        </div>
                      </div>
                    </div>
                    <div class="p-4">
                      <div class="mb-4">
                        <div class="flex border-b">
                          <button class="tab-button active" data-tab="properties">
                            <i data-lucide="building-2" class="h-4 w-4 mr-2"></i>
                            Properties
                          </button>
                          <button class="tab-button" data-tab="units">
                            <i data-lucide="home" class="h-4 w-4 mr-2"></i>
                            Units
                          </button>
                        </div>
                      </div>
                      <div id="properties-tab" class="tab-content active">
                        <table class="min-w-full divide-y divide-gray-200">
                          <thead>
                            <tr>
                              <th class="bg-green-50 text-green-900 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                              <th class="bg-green-50 text-green-900 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Property Name</th>
                              <th class="bg-green-50 text-green-900 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Type</th>
                              <th class="bg-green-50 text-green-900 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Units</th>
                              <th class="bg-green-50 text-green-900 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Address</th>
                              <th class="bg-green-50 text-green-900 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                              <th class="bg-green-50 text-green-900 px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">Actions</th>
                            </tr>
                          </thead>
                          <tbody class="bg-white divide-y divide-gray-200" id="propertiesTableBody">
                            <!-- Table rows will be populated by JavaScript -->
                          </tbody>
                        </table>
                      </div>
                      <div id="units-tab" class="tab-content">
                        <div class="text-center p-12 text-gray-500">
                          <p>Unit details would be displayed here</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            
                <!-- Property Details Modal -->
                <div id="propertyDetailsModal" class="modal">
                  <div class="modal-content">
                    <div class="flex justify-between items-center mb-4">
                      <h2 class="text-xl font-bold flex items-center">
                        <i data-lucide="building-2" class="h-5 w-5 mr-2 text-green-600"></i>
                        Property Details
                      </h2>
                      <span class="close">&times;</span>
                    </div>
                    <p class="text-gray-500 mb-6">Detailed information about the selected sectional title property</p>
            
                    <div id="propertyDetailsContent" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                      <!-- Property details will be populated by JavaScript -->
                    </div>
            
                    <div class="flex justify-end mt-6">
                      <button id="closePropertyDetails" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50">
                        Close
                      </button>
                    </div>
                  </div>
                </div>
              </div>
      
  
        </div>

        <!-- Footer -->
        @include('admin.footer')
      </div>
 
      <script>
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Mock data for properties
        const properties = [
          {
            id: "ST-2025-001",
            name: "Kano City Plaza",
            type: "Commercial",
            units: 24,
            address: "Murtala Mohammed Way, Kano",
            coordinates: [11.9959, 8.5164],
            owner: "Alhaji Ibrahim Dantata",
            status: "Active",
            fileNo: "KN/2025/COM/001",
            area: "2,450 sqm",
            landUse: "Commercial",
            geometry: "polygon",
          },
          {
            id: "ST-2025-002",
            name: "Bompai Business Center",
            type: "Mixed Use",
            units: 18,
            address: "Bompai Industrial Area, Kano",
            coordinates: [12.0059, 8.5364],
            owner: "Mallam Sani Abubakar",
            status: "Pending",
            fileNo: "KN/2025/MIX/002",
            area: "1,850 sqm",
            landUse: "Mixed Use",
            geometry: "polygon",
          },
          {
            id: "ST-2025-003",
            name: "Sabon Gari Mall",
            type: "Commercial",
            units: 32,
            address: "Sabon Gari, Kano",
            coordinates: [11.9859, 8.5264],
            owner: "Hajiya Amina Yusuf",
            status: "Active",
            fileNo: "KN/2025/COM/003",
            area: "3,200 sqm",
            landUse: "Commercial",
            geometry: "polygon",
          },
          {
            id: "ST-2025-004",
            name: "Kwari Market Complex",
            type: "Commercial",
            units: 45,
            address: "Kwari Market, Kano",
            coordinates: [12.0159, 8.5064],
            owner: "Musa Usman Bayero",
            status: "Active",
            fileNo: "KN/2025/COM/004",
            area: "4,500 sqm",
            landUse: "Commercial",
            geometry: "polygon",
          },
          {
            id: "ST-2025-005",
            name: "Nasarawa Heights",
            type: "Residential",
            units: 12,
            address: "Nasarawa GRA, Kano",
            coordinates: [11.9759, 8.5464],
            owner: "Dr. Abdullahi Mohammed",
            status: "Pending",
            fileNo: "KN/2025/RES/005",
            area: "1,200 sqm",
            landUse: "Residential",
            geometry: "polygon",
          },
        ];
    
        // Global variables
        let map;
        let mapZoom = 14;
        let selectedProperty = null;
        
        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
          // Populate properties table
          populatePropertiesTable();
          
          // Initialize map
          initializeMap();
          
          // Set up event listeners
          setupEventListeners();
        });
        
        // Populate properties table
        function populatePropertiesTable() {
          const tableBody = document.getElementById('propertiesTableBody');
          tableBody.innerHTML = '';
          
          properties.forEach(property => {
            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-50';
            
            // Determine badge colors
            const typeBadgeClass = property.type === "Commercial" 
              ? "bg-cyan-100 text-cyan-800" 
              : property.type === "Residential" 
                ? "bg-teal-100 text-teal-800" 
                : "bg-blue-100 text-blue-800";
                
            const statusBadgeClass = property.status === "Active" 
              ? "bg-green-100 text-green-800" 
              : "bg-yellow-100 text-yellow-800";
            
            row.innerHTML = `
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${property.id}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${property.name}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${typeBadgeClass}">
                  ${property.type}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${property.units}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${property.address}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusBadgeClass}">
                  ${property.status}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <div class="flex justify-end gap-2">
                  <button class="text-green-600 hover:text-green-900 view-property" data-id="${property.id}">
                    <i data-lucide="eye" class="h-4 w-4 mr-1"></i>
                    View
                  </button>
                  <button class="text-green-600 hover:text-green-900 locate-property" data-id="${property.id}">
                    <i data-lucide="map-pin" class="h-4 w-4 mr-1"></i>
                    Locate
                  </button>
                </div>
              </td>
            `;
            
            tableBody.appendChild(row);
          });
          
          // Re-initialize Lucide icons for the new content
          lucide.createIcons();
        }
        
        // Initialize Leaflet map
        function initializeMap() {
          // Create a style element for Leaflet CSS
          const linkElement = document.createElement("link");
          linkElement.rel = "stylesheet";
          linkElement.href = "https://unpkg.com/leaflet@1.9.4/dist/leaflet.css";
          document.head.appendChild(linkElement);
    
          // Load Leaflet script
          const script = document.createElement("script");
          script.src = "https://unpkg.com/leaflet@1.9.4/dist/leaflet.js";
          script.onload = () => {
            // Initialize map after script is loaded
            if (window.L && document.getElementById('mapContainer')) {
              // Hide loading indicator
              document.getElementById('mapLoadingIndicator').style.display = 'none';
              
              // Center coordinates for Kano, Nigeria
              const kanoCoordinates = [11.9959, 8.5164];
    
              // Initialize the map with simple options
              map = window.L.map('mapContainer', {
                center: kanoCoordinates,
                zoom: 13,
                zoomControl: false, // We'll add custom zoom controls
              });
    
              // Add OpenStreetMap tile layer
              window.L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19,
              }).addTo(map);
    
              // Add property markers
              const markers = [];
              properties.forEach((property) => {
                // Create marker with custom icon
                const markerColor =
                  property.type === "Commercial" ? "#0e7490" : property.type === "Residential" ? "#0f766e" : "#0369a1";
    
                const customIcon = window.L.divIcon({
                  className: "custom-map-marker",
                  html: `<div style="background-color: ${markerColor}; width: 20px; height: 20px; border-radius: ${
                    property.geometry === "polygon" ? "4px" : "50%"
                  }; border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);"></div>`,
                  iconSize: [20, 20],
                  iconAnchor: [10, 10],
                });
    
                const marker = window.L.marker(property.coordinates, { icon: customIcon })
                  .addTo(map)
                  .bindPopup(`
                    <div style="min-width: 200px;">
                      <h3 style="margin: 0 0 5px; font-size: 16px; font-weight: bold;">${property.name}</h3>
                      <p style="margin: 0 0 5px;"><strong>ID:</strong> ${property.id}</p>
                      <p style="margin: 0 0 5px;"><strong>Type:</strong> ${property.type}</p>
                      <p style="margin: 0 0 5px;"><strong>Units:</strong> ${property.units}</p>
                      <p style="margin: 0 0 5px;"><strong>Address:</strong> ${property.address}</p>
                      <button style="background-color: #0f766e; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; margin-top: 5px;" onclick="viewPropertyDetails('${property.id}')">View Details</button>
                    </div>
                  `);
    
                markers.push(marker);
              });
    
              // Create a feature group for all markers to easily fit bounds
              const markerGroup = window.L.featureGroup(markers).addTo(map);
              map.fitBounds(markerGroup.getBounds().pad(0.1));
    
              // Add scale control
              window.L.control.scale().addTo(map);
    
              // Update zoom level when map zooms
              map.on("zoomend", () => {
                mapZoom = map.getZoom();
                document.getElementById('zoomLevel').textContent = mapZoom;
              });
    
              // Force a resize after map is loaded
              setTimeout(() => {
                map.invalidateSize();
              }, 500);
            }
          };
          document.body.appendChild(script);
        }
        
        // Set up event listeners
        function setupEventListeners() {
          // Tab switching
          const tabButtons = document.querySelectorAll('.tab-button');
          tabButtons.forEach(button => {
            button.addEventListener('click', function() {
              const tabId = this.getAttribute('data-tab');
              
              // Deactivate all tabs
              tabButtons.forEach(btn => btn.classList.remove('active'));
              document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
              
              // Activate selected tab
              this.classList.add('active');
              document.getElementById(`${tabId}-tab`).classList.add('active');
            });
          });
          
          // Map controls
          document.getElementById('zoomIn').addEventListener('click', function() {
            if (map) {
              map.setZoom(map.getZoom() + 1);
            }
          });
          
          document.getElementById('zoomOut').addEventListener('click', function() {
            if (map) {
              map.setZoom(map.getZoom() - 1);
            }
          });
          
          document.getElementById('resetView').addEventListener('click', function() {
            if (map) {
              map.setView([11.9959, 8.5164], 13);
            }
          });
          
          // Base map selection
          document.getElementById('baseMapSelect').addEventListener('change', function() {
            if (!map) return;
            
            // Remove existing tile layers
            map.eachLayer((layer) => {
              if (layer instanceof L.TileLayer) {
                map.removeLayer(layer);
              }
            });
            
            // Add the selected tile layer
            switch (this.value) {
              case "satellite":
                L.tileLayer(
                  "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
                  {
                    attribution:
                      "Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community",
                  }
                ).addTo(map);
                break;
              case "streets":
                L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                }).addTo(map);
                break;
              case "terrain":
                L.tileLayer("https://stamen-tiles-{s}.a.ssl.fastly.net/terrain/{z}/{x}/{y}{r}.png", {
                  attribution:
                    'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                }).addTo(map);
                break;
              case "hybrid":
                L.tileLayer(
                  "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
                  {
                    attribution:
                      "Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community",
                  }
                ).addTo(map);
                L.tileLayer("https://stamen-tiles-{s}.a.ssl.fastly.net/toner-lines/{z}/{x}/{y}{r}.png", {
                  attribution:
                    'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                  opacity: 0.5,
                }).addTo(map);
                break;
            }
          });
          
          // Layer toggles
          document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
              // In a real implementation, this would toggle actual map layers
              console.log(`Layer ${this.id} is now ${this.checked ? 'visible' : 'hidden'}`);
            });
          });
          
          // Property view buttons
          document.addEventListener('click', function(e) {
            if (e.target.classList.contains('view-property') || e.target.parentElement.classList.contains('view-property')) {
              const button = e.target.classList.contains('view-property') ? e.target : e.target.parentElement;
              const propertyId = button.getAttribute('data-id');
              viewPropertyDetails(propertyId);
            }
            
            if (e.target.classList.contains('locate-property') || e.target.parentElement.classList.contains('locate-property')) {
              const button = e.target.classList.contains('locate-property') ? e.target : e.target.parentElement;
              const propertyId = button.getAttribute('data-id');
              locateProperty(propertyId);
            }
          });
          
          // Modal close buttons
          document.querySelector('.close').addEventListener('click', function() {
            document.getElementById('propertyDetailsModal').style.display = 'none';
          });
          
          document.getElementById('closePropertyDetails').addEventListener('click', function() {
            document.getElementById('propertyDetailsModal').style.display = 'none';
          });
          
          // Close modal when clicking outside
          window.addEventListener('click', function(e) {
            if (e.target === document.getElementById('propertyDetailsModal')) {
              document.getElementById('propertyDetailsModal').style.display = 'none';
            }
          });
        }
        
        // View property details
        function viewPropertyDetails(propertyId) {
          const property = properties.find(p => p.id === propertyId);
          if (!property) return;
          
          selectedProperty = property;
          
          const content = document.getElementById('propertyDetailsContent');
          
          // Determine badge classes
          const statusBadgeClass = property.status === "Active" 
            ? "bg-green-100 text-green-800" 
            : "bg-yellow-100 text-yellow-800";
          
          content.innerHTML = `
            <div class="md:col-span-2 space-y-4">
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <h3 class="text-sm font-medium text-gray-500">Property ID</h3>
                  <p class="font-medium">${property.id}</p>
                </div>
                <div>
                  <h3 class="text-sm font-medium text-gray-500">File Number</h3>
                  <p class="font-medium">${property.fileNo}</p>
                </div>
                <div>
                  <h3 class="text-sm font-medium text-gray-500">Property Name</h3>
                  <p class="font-medium">${property.name}</p>
                </div>
                <div>
                  <h3 class="text-sm font-medium text-gray-500">Property Type</h3>
                  <p class="font-medium">${property.type}</p>
                </div>
                <div>
                  <h3 class="text-sm font-medium text-gray-500">Number of Units</h3>
                  <p class="font-medium">${property.units}</p>
                </div>
                <div>
                  <h3 class="text-sm font-medium text-gray-500">Land Use</h3>
                  <p class="font-medium">${property.landUse}</p>
                </div>
                <div>
                  <h3 class="text-sm font-medium text-gray-500">Area</h3>
                  <p class="font-medium">${property.area}</p>
                </div>
                <div>
                  <h3 class="text-sm font-medium text-gray-500">Status</h3>
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusBadgeClass}">
                    ${property.status}
                  </span>
                </div>
              </div>
    
              <div>
                <h3 class="text-sm font-medium text-gray-500">Address</h3>
                <p class="font-medium">${property.address}</p>
              </div>
    
              <div>
                <h3 class="text-sm font-medium text-gray-500">Owner</h3>
                <p class="font-medium">${property.owner}</p>
              </div>
    
              <div>
                <h3 class="text-sm font-medium text-gray-500">Coordinates</h3>
                <p class="font-medium">
                  ${property.coordinates[0]}°N, ${property.coordinates[1]}°E
                </p>
              </div>
    
              <hr class="border-gray-200">
    
              <div>
                <h3 class="text-sm font-medium mb-2">Documents</h3>
                <div class="space-y-2">
                  <div class="flex items-center justify-between p-2 border rounded-md">
                    <div class="flex items-center">
                      <i data-lucide="file-text" class="h-4 w-4 mr-2 text-blue-600"></i>
                      <span>Property Survey Plan</span>
                    </div>
                    <button class="text-gray-600 hover:text-gray-900">
                      <i data-lucide="eye" class="h-4 w-4 mr-1"></i>
                      View
                    </button>
                  </div>
                  <div class="flex items-center justify-between p-2 border rounded-md">
                    <div class="flex items-center">
                      <i data-lucide="file-text" class="h-4 w-4 mr-2 text-blue-600"></i>
                      <span>Architectural Plans</span>
                    </div>
                    <button class="text-gray-600 hover:text-gray-900">
                      <i data-lucide="eye" class="h-4 w-4 mr-1"></i>
                      View
                    </button>
                  </div>
                  <div class="flex items-center justify-between p-2 border rounded-md">
                    <div class="flex items-center">
                      <i data-lucide="file-text" class="h-4 w-4 mr-2 text-blue-600"></i>
                      <span>Title Documents</span>
                    </div>
                    <button class="text-gray-600 hover:text-gray-900">
                      <i data-lucide="eye" class="h-4 w-4 mr-1"></i>
                      View
                    </button>
                  </div>
                </div>
              </div>
            </div>
    
            <div class="md:col-span-1">
              <div class="border rounded-md p-4 h-full flex flex-col">
                <h3 class="text-sm font-medium mb-2">Property Preview</h3>
                <div class="bg-blue-50 rounded-md flex-1 flex items-center justify-center mb-4">
                  <i data-lucide="building-2" class="h-16 w-16 text-green-600 opacity-30"></i>
                </div>
                <div class="space-y-2">
                  <button
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-md text-sm flex items-center justify-center"
                    onclick="locateProperty('${property.id}'); document.getElementById('propertyDetailsModal').style.display = 'none';"
                  >
                    <i data-lucide="map-pin" class="h-4 w-4 mr-2"></i>
                    View on Map
                  </button>
                  <button class="w-full border border-gray-300 hover:bg-gray-50 py-2 px-4 rounded-md text-sm flex items-center justify-center">
                    <i data-lucide="printer" class="h-4 w-4 mr-2"></i>
                    Print Details
                  </button>
                </div>
              </div>
            </div>
          `;
          
          // Re-initialize Lucide icons for the new content
          lucide.createIcons();
          
          // Show the modal
          document.getElementById('propertyDetailsModal').style.display = 'block';
        }
        
        // Locate property on map
        function locateProperty(propertyId) {
          const property = properties.find(p => p.id === propertyId);
          if (!property || !map) return;
          
          map.setView(property.coordinates, 16);
          
          // Find and open the popup for this property
          map.eachLayer((layer) => {
            if (layer instanceof L.Marker) {
              const popupContent = layer.getPopup()?.getContent() || "";
              if (popupContent.includes(property.id)) {
                layer.openPopup();
              }
            }
          });
        }
      </script>
@endsection
