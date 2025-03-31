<div class="record-detail">
  <h4 class="mb-3">Record Details</h4>
  <p><strong>File No:</strong> {{ $record->fileno }}</p>
  <p><strong>Owner:</strong>
    @if($record->applicant_type === 'corporate')
      {{ $record->corporate_name }}
    @else
      {{ $record->first_name }} {{ $record->middle_name }} {{ $record->surname }}
    @endif
  </p>
  <p><strong>Identification:</strong></p>
  @if($record->passport)
    <p>Passport:</p>
    <img src="{{ asset('storage/' . $record->passport) }}" alt="Passport" style="max-width:200px;">
  @elseif($record->rc_number)
    <p>RC Number: {{ $record->rc_number }}</p>
  @else
    <p>No passport or RC number available.</p>
  @endif
  <!-- ...other record details as needed... -->
</div>
