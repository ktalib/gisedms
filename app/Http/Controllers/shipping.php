<?php
// Database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$tracking_number = "";
$shipment_id = "";
$tracking_updates = [];
$message = "";
$valid_statuses = ['Pending', 'In Transit', 'Delivered', 'Delayed', 'Returned'];

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If tracking number is submitted
    if (isset($_POST['search_tracking'])) {
        $tracking_number = $_POST['tracking_number'];
        
        // Fetch shipment ID
        $sql = "SELECT id FROM shipments WHERE tracking_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $tracking_number);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $shipment_id = $row['id'];
            
            // Fetch tracking updates
            $sql = "SELECT * FROM tracking_updates WHERE shipment_id = ? ORDER BY created_at DESC";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $shipment_id);
            $stmt->execute();
            $tracking_updates = $stmt->get_result();
        } else {
            $message = "No shipment found with that tracking number.";
        }
    }
    
    // If update form is submitted
    if (isset($_POST['update_tracking'])) {
        $update_id = $_POST['update_id'];
        $shipment_id = $_POST['shipment_id'];
        $status = $_POST['status'];
        $location = $_POST['location'];
        $notes = $_POST['notes'];
        
        // Validate status
        if (!in_array($status, $valid_statuses)) {
            $message = "Invalid status value. Please use one of: " . implode(', ', $valid_statuses);
        } else {
            // Begin transaction
            $conn->begin_transaction();
            
            try {
                // Update tracking information
                $sql = "UPDATE tracking_updates SET status = ?, location = ?, notes = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssi", $status, $location, $notes, $update_id);
                $stmt->execute();
                
                // Update shipment status
                $sql = "UPDATE shipments SET status = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $status, $shipment_id);
                $stmt->execute();
                
                // Commit transaction
                $conn->commit();
                $message = "Tracking update modified successfully!";
                
                // Refresh tracking updates
                $sql = "SELECT * FROM tracking_updates WHERE shipment_id = ? ORDER BY created_at DESC";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $shipment_id);
                $stmt->execute();
                $tracking_updates = $stmt->get_result();
            } catch (Exception $e) {
                $conn->rollback();
                $message = "Error updating record: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking Update System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            color: #333;
            text-align: center;
        }
        
        .search-form {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-right: 10px;
        }
        
        button {
            padding: 10px 15px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        button:hover {
            background: #45a049;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        table, th, td {
            border: 1px solid #ddd;
        }
        
        th, td {
            padding: 12px;
            text-align: left;
        }
        
        th {
            background-color: #f2f2f2;
        }
        
        .update-form {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-top: 10px;
        }
        
        .update-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .update-form input[type="text"], 
        .update-form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .update-form textarea {
            height: 100px;
        }
        
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }
        
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tracking Update System</h1>
        
        <!-- Search Form -->
        <form class="search-form" method="POST">
            <input type="text" name="tracking_number" placeholder="Enter Tracking Number" value="<?php echo $tracking_number; ?>" required>
            <button type="submit" name="search_tracking">Search</button>
        </form>
        
        <!-- Display messages -->
        <?php if (!empty($message)): ?>
            <div class="message <?php echo strpos($message, 'successfully') !== false ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <!-- Display Tracking Updates -->
        <?php if (!empty($tracking_updates) && $tracking_updates->num_rows > 0): ?>
            <h2>Tracking Updates for: <?php echo htmlspecialchars($tracking_number); ?></h2>
            
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Status</th>
                        <th>Location</th>
                        <th>Notes</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $tracking_updates->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td><?php echo htmlspecialchars($row['location']); ?></td>
                            <td><?php echo htmlspecialchars($row['notes']); ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td>
                                <button onclick="showUpdateForm('<?php echo $row['id']; ?>')">Edit</button>
                            </td>
                        </tr>
                        <tr id="update-form-<?php echo $row['id']; ?>" style="display: none;">
                            <td colspan="6">
                                <form class="update-form" method="POST">
                                    <input type="hidden" name="update_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="shipment_id" value="<?php echo $shipment_id; ?>">
                                    
                                    <label for="status">Status:</label>
                                    <select name="status" required>
                                        <?php foreach ($valid_statuses as $valid_status): ?>
                                            <option value="<?php echo $valid_status; ?>" <?php echo ($row['status'] === $valid_status) ? 'selected' : ''; ?>>
                                                <?php echo $valid_status; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    
                                    <label for="location">Location:</label>
                                    <input type="text" name="location" value="<?php echo htmlspecialchars($row['location']); ?>" required>
                                    
                                    <label for="notes">Notes:</label>
                                    <textarea name="notes"><?php echo htmlspecialchars($row['notes']); ?></textarea>
                                    
                                    <button type="submit" name="update_tracking">Update</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php elseif (!empty($tracking_number)): ?>
            <p>No tracking updates found for this shipment.</p>
        <?php endif; ?>
    </div>
    
    <script>
        function showUpdateForm(id) {
            const form = document.getElementById('update-form-' + id);
            form.style.display = form.style.display === 'none' ? 'table-row' : 'none';
        }
    </script>
</body>
</html>