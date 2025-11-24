<?php if ($role === 'admin'): ?>
<div class="admin-section">
    <h3>Admin Panel</h3>
    <p>You are an admin — you have elevated privileges.</p>

    <ul>
        <li><a href="admin/manage-users.php">Manage Users</a></li>
        <li><a href="admin/manage-products.php">Manage Products</a></li>
        <li><a href="admin/manage-orders.php">Manage Orders</a></li>
    </ul>
</div>
<?php endif; ?>
