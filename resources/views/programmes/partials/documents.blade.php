<div class="bg-white border border-gray-200 rounded-lg shadow-sm">
  <div class="p-4 border-b">
    <h3 class="text-sm font-medium">{{ $documentsSectionTitle ?? 'Documents' }}</h3>
    <p class="text-xs text-gray-500">{{ $documentsSectionDescription ?? '' }}</p>
  </div>
  <input type="hidden" id="application_id" value="{{ $applicationId ?? $application->id }}">
  <input type="hidden" name="fileno" value="{{ $fileNumber ?? $application->fileno }}">
  <div class="p-4 space-y-4">
    <div class="grid grid-cols-2 gap-4">
      @php
        // Ensure documents is decoded from JSON if needed
        $documentItems = $documents ?? (is_string($application->documents)
          ? json_decode($application->documents, true)
          : $application->documents);

        // Document types to display
        $documentTypes = $documentTypesToDisplay ?? [
          'application_letter' => 'Application Letter',
          'building_plan' => 'Building Plan', 
          'architectural_design' => 'Architectural Design',
          'ownership_document' => 'Ownership Document'
        ];
      @endphp
      
      @foreach($documentTypes as $docKey => $docTitle)
        @if (isset($documentItems[$docKey]))
          <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="h-48 bg-gray-100 relative">
              <img src="{{ asset('storage/app/public/' . $documentItems[$docKey]['path']) }}"
                alt="{{ $docTitle }}" class="w-full h-full object-cover">
              <div class="absolute top-2 right-2">
                <button class="p-1 bg-white rounded-full shadow-sm hover:bg-gray-100"
                  onclick="previewDocument('{{ asset('storage/app/public/' . $documentItems[$docKey]['path']) }}', '{{ $docTitle }}')">
                  <i data-lucide="maximize-2" class="w-4 h-4 text-gray-700"></i>
                </button>
              </div>
            </div>
            <div class="p-3">
              <h5 class="text-sm font-medium">{{ $docTitle }}</h5>
              <p class="text-xs text-gray-500 mt-1">Uploaded on:
                {{ \Carbon\Carbon::parse($documentItems[$docKey]['uploaded_at'])->format('Y-m-d') }}
              </p>
              <div class="flex mt-2 gap-2">
                <a href="{{ asset('storage/app/public/' . $documentItems[$docKey]['path']) }}"
                  download
                  class="text-xs px-2 py-1 bg-blue-50 text-blue-600 rounded-md flex items-center">
                  <i data-lucide="download" class="w-3 h-3 mr-1"></i> Download
                </a>
                <button
                  class="text-xs px-2 py-1 bg-gray-50 text-gray-600 rounded-md flex items-center"
                  onclick="previewDocument('{{ asset('storage/app/public/' . $documentItems[$docKey]['path']) }}', '{{ $docTitle }}')">
                  <i data-lucide="eye" class="w-3 h-3 mr-1"></i> View
                </button>
              </div>
            </div>
          </div>
        @else
          <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden p-4 flex flex-col items-center justify-center">
            <div class="text-gray-400 mb-2">
              <i data-lucide="file-question" class="w-10 h-10"></i>
            </div>
            <p class="text-sm text-gray-500">No {{ strtolower($docTitle) }} uploaded yet</p>
          </div>
        @endif
      @endforeach
    </div>

    <hr class="my-4">

    <div class="flex justify-between items-center">
      <div class="flex gap-2">
        <button type="button" class="flex items-center px-3 py-1 text-xs bg-white text-black p-2 border border-gray-500 rounded-md hover:bg-gray-800" id="{{ $docBackBtnId ?? 'docBackBtn' }}">
          <i data-lucide="undo-2" class="w-3.5 h-3.5 mr-1.5"></i>
          {{ $docBackBtnLabel ?? 'Back' }}
        </button>    
        
        <button type="submit" class="flex items-center px-3 py-1 text-xs bg-green-700 text-white rounded-md hover:bg-gray-800" id="{{ $docSubmitBtnId ?? 'docSubmitBtn' }}">
          <i data-lucide="send-horizontal" class="w-3.5 h-3.5 mr-1.5"></i>
          {{ $docSubmitBtnLabel ?? 'Submit' }}
        </button>
      </div>
    </div>
  </div>
</div>
