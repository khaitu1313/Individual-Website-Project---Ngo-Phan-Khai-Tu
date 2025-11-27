<?php if ($role === 'admin'): ?>
<div class="admin-section">
    <h3 class="admin-title">Admin Dashboard</h3>
    <p class="admin-desc">Welcome, Admin! Select a management option below:</p>

    <div class="admin-grid">
        <a href="dashboard/admin/manage-users.php" class="admin-card">
            <h4>👤 Users</h4>
            <p>View, edit, and remove user accounts.</p>
        </a>

        <a href="dashboard/admin/manage-products.php" class="admin-card">
            <h4>🛒 Products</h4>
            <p>Add, edit, or delete products in your shop.</p>
        </a>

        <a href="dashboard/admin/manage-orders.php" class="admin-card">
            <h4>📦 Orders</h4>
            <p>Review and update customer orders.</p>
        </a>
    </div>
</div>
<?php endif; ?>
