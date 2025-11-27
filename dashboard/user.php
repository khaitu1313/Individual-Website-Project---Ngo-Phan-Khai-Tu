<?php if ($role !== 'admin'): ?>
<div class="user-section">

    <h3 class="section-title">Customer Dashboard</h3>
    <p class="section-desc">Manage your profile, cart, and orders.</p>

    <div class="user-grid">
        <a href="profile.php" class="user-card">
            <h4>Edit Profile</h4>
            <p>Update your account information.</p>
        </a>

        <a href="cart.php" class="user-card">
            <h4>Your Cart</h4>
            <p>View items you have added.</p>
        </a>

        <a href="order.php" class="user-card">
            <h4>Your Orders</h4>
            <p>Check your purchase history.</p>
        </a>
    </div>

</div>
<?php endif; ?>
