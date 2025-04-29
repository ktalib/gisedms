
<style>
    .ck-editor__editable {
    min-height: 200px;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"],
    textarea,
    select {

    }

    input:disabled,
    select:disabled,
    textarea:disabled {
    background-color: #bbbbbb;
    }

    #myDiv {
    display: none;
    transition: all 0.3s ease-in-out;
    }
    select,
    input {
    transition: all 0.2s ease-in-out;
    }
    select:focus,
    input:focus {
    transform: translateY(-1px);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    #Previewflenumber {
    font-family: monospace;
    letter-spacing: 0.05em;
    }
    .bootstrap-tagsinput {
    width: 100%;
    padding: 0.5rem;
    border-radius: 0.375rem;
    min-height: 55px;
    background-color: #fdfdfd;
    }

    .bootstrap-tagsinput .tag {
    background-color: #3b82f6;
    color: white;
    padding: 3px 7px;
    border-radius: 3px;
    margin-right: 4px;

    }



    .step-circle {
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 500;
    }
    .step-circle.active-tab {
    background-color: #10b981;
    color: white;
    }
    .step-circle.inactive-tab {
    background-color: #f3f4f6;
    color: #6b7280;
    }
    .form-section {
    display: none;
    }
    .form-section.active-tab {
    display: block;
    }
    .upload-box {
    border: 2px dashed #e5e7eb;
    border-radius: 0.375rem;
    padding: 1.5rem;
    text-align: center;
    cursor: pointer;
    transition: border-color 0.2s;
    }
    .upload-box:hover {
    border-color: #3b82f6;
    }
    </style>