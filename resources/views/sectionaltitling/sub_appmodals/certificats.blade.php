<div class="modal fade" id="certificateModal{{ $subApplication->id }}" tabindex="-1"
    aria-labelledby="certificateModalLabel{{ $subApplication->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:300px;">
        <div class="modal-content">
            <div class="modal-header" style="height: 30px;">
                <h5 class="modal-title" id="certificateModalLabel{{ $subApplication->id }}">Certificate
                    Actions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #f1f1f1;">
                
                <div>
                    <div class="button-grid">
                        <button class="bttn" data-bs-toggle="modal"
                            data-bs-target="#viewTDPModal{{ $subApplication->id }}">
                            View TDP
                            <i class="material-icons" style="color: #4CAF50;">visibility</i>
                        </button>
                        <button class="bttn" data-bs-toggle="modal"
                            data-bs-target="#printTDPModal{{ $subApplication->id }}">
                            Print TDP
                            <i class="material-icons" style="color: #2196F3;">print</i>
                        </button>
                        <button class="bttn" data-bs-toggle="modal"
                            data-bs-target="#viewCofOModal{{ $subApplication->id }}">
                            View CofO
                            <i class="material-icons" style="color: #FF9800;">visibility</i>
                        </button>
                        <button class="bttn" data-bs-toggle="modal"
                            data-bs-target="#printCofOModal{{ $subApplication->id }}">
                            Print CofO
                            <i class="material-icons" style="color: #9C27B0;">print</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewTDPModal{{ $subApplication->id }}" tabindex="-1"
    aria-labelledby="viewTDPModalLabel{{ $subApplication->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewTDPModalLabel{{ $subApplication->id }}">View TDP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="viewTDPContainer{{ $subApplication->id }}" style="height: 80vh;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Print TDP Modal -->
<div class="modal fade" id="printTDPModal{{ $subApplication->id }}" tabindex="-1"
    aria-labelledby="printTDPModalLabel{{ $subApplication->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="printTDPModalLabel{{ $subApplication->id }}">Print TDP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="printTDPContainer{{ $subApplication->id }}" style="height: 80vh;"></div>
            </div>
        </div>
    </div>
</div>

<!-- View CofO Modal -->
<div class="modal fade" id="viewCofOModal{{ $subApplication->id }}" tabindex="-1"
    aria-labelledby="viewCofOModalLabel{{ $subApplication->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCofOModalLabel{{ $subApplication->id }}">View CofO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="viewCofOContainer{{ $subApplication->id }}" style="height: 80vh;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Print CofO Modal -->
<div class="modal fade" id="printCofOModal{{ $subApplication->id }}" tabindex="-1"
    aria-labelledby="printCofOModalLabel{{ $subApplication->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="printCofOModalLabel{{ $subApplication->id }}">Print CofO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="printCofOContainer{{ $subApplication->id }}" style="height: 80vh;"></div>
            </div>
        </div>
    </div>
</div>
