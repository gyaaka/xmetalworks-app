<?php include_once "../../includes/header.php"; 
include_once "../../config/database.php";
include_once "../../models/Customer.php";

$database = new Database();
$db = $database->getConnection();
$customer = new Customer($db);
$stmt = $customer->read();
?>

<div class="container mt-5">
    <h2>Customers</h2>
    <a href="create.php" class="btn btn-primary mb-3">Add New Customer</a>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Location</th>
                <th>Credit</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?= $row['customer_id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['contact_number']) ?></td>
                <td><?= htmlspecialchars($row['location']) ?></td>
                <td>$<?= number_format($row['credit'], 2) ?></td>
                <td>
                    <a href="view.php?id=<?= $row['customer_id'] ?>" class="btn btn-info">View</a>
                    <a href="edit.php?id=<?= $row['customer_id'] ?>" class="btn btn-warning">Edit</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include_once "../../includes/footer.php"; ?>
