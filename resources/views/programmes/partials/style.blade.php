<style>
    .badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.25rem 0.5rem;
      border-radius: 0.25rem;
      font-size: 0.75rem;
      font-weight: 500;
    }
    .badge-approved {
      background-color: #d1fae5;
      color: #059669;
    }
    .badge-pending {
      background-color: #fef3c7;
      color: #d97706;
    }
    .badge-declined {
      background-color: #fee2e2;
      color: #dc2626;
    }
    .table-header {
      background-color: #f9fafb;
      font-weight: 500;
      color: rgb(13, 136, 13);
      text-align: left;
      padding: 0.75rem 1rem;
      border-bottom: 1px solid #e5e7eb;
    }
    .table-cell {
      padding: 0.75rem 1rem;
      border-bottom: 1px solid #e5e7eb;
    }
    .tab-active {
      background-color: rgb(0, 117, 20);
      border-color: rgb(13, 136, 13);;
      border-bottom-color: white;
      font-weight: 600;
    }
    .tab-inactive {
      background-color: #f9fafb;
      border-color: transparent;
    }
    .chart-container {
      height: 300px;
      margin-bottom: 2rem;
      position: relative; /* Add position relative for chart container */
    }
    /* Add a loading indicator for charts */
    .chart-loading {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: rgba(255, 255, 255, 0.8);
      z-index: 10;
    }
    /* Print styles */
    @media print {
      body * {
        visibility: hidden;
      }
      .printable, .printable * {
        visibility: visible;
      }
      .no-print {
        display: none !important;
      }
      .printable {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
      }
      .page-break {
        page-break-after: always;
      }
      table {
        width: 100%;
        border-collapse: collapse;
      }
      table th, table td {
        border: 1px solid #ddd;
        padding: 8px;
      }
      .table-header {
        background-color: #f2f2f2 !important;
        color: black !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }
      .print-header {
        text-align: center;
        margin-bottom: 20px;
      }
    }
    /* Print Loading Overlay */
    #print-loading {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(255,255,255,0.9);
      z-index: 9999;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
    }
    .spinner {
      width: 40px;
      height: 40px;
      border: 4px solid #f3f3f3;
      border-top: 4px solid #3498db;
      border-radius: 50%;
      animation: spin 1s linear infinite;
      margin-bottom: 15px;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
</style>
 
 