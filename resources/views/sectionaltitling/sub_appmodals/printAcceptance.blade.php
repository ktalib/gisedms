<div class="modal fade" id="viewPrintAcceptanceModal{{ $subApplication->id }}" tabindex="-1"
    aria-labelledby="viewPrintAcceptanceModalLabel{{ $subApplication->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewPrintAcceptanceModalLabel{{ $subApplication->id }}">View
                    & Print Acceptance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <iframe id="acceptanceIframe{{ $subApplication->id }}"
                        src="{{ route('sectionaltitling.AcceptLetter') }}"
                        style="width:100%; height:500px;" frameborder="0"></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"
                    onclick="printIframe('acceptanceIframe{{ $subApplication->id }}')">Print</button>
            </div>
        </div>
    </div>
</div>