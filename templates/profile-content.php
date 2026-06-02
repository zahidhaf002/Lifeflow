<h2>Your Profile</h2>
<p style="color:#adb5bd; margin-bottom:30px;">Manage your account and preferences</p>

<?php if (!empty($success)): ?>
    <div style="background: #40c057; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
        <?php echo escape($success); ?>
    </div>
<?php endif; ?>

<?php if (!empty($passwordSuccess)): ?>
    <div style="background: #40c057; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
        <?php echo escape($passwordSuccess); ?>
    </div>
<?php endif; ?>

<?php if (!empty($passwordError)): ?>
    <div style="background: #dc3545; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
        <?php echo escape($passwordError); ?>
    </div>
<?php endif; ?>

<div style="display:grid; grid-template-columns:1fr 2fr; gap:30px;">
    <div class="card">
        <h3 class="card-title">Account Information</h3>
        <div style="text-align:center; margin-top:20px;">
            <div style="width:100px; height:100px; background:#4dabf7; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 15px; font-size:36px; color:white;">
                <?php echo getInitials($user['full_name']); ?>
            </div>
            <div style="font-size:20px; color:#e0e0e0; margin-bottom:5px;"><?php echo escape($user['full_name']); ?></div>
            <div style="color:#adb5bd; margin-bottom:20px;"><?php echo escape($user['email']); ?></div>
            <div style="background:#252525; padding:10px; border-radius:5px; color:#40c057;">
                <i class="fas fa-<?php echo $user['role'] === 'admin' ? 'crown' : 'user-graduate'; ?>"></i> 
                <?php echo ucfirst($user['role']); ?> Account
            </div>
            <div style="margin-top:20px; color:#868e96; font-size:14px;">
                Member since: <?php echo date('M j, Y', strtotime($user['created_at'])); ?>
            </div>
        </div>
    </div>
    
    <div class="card">
        <h3 class="card-title">Settings</h3>
        
        <form method="POST" style="margin-top:20px;">
            <h4 style="color:#f0f0f0; margin-bottom:15px;">Personal Details</h4>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px; margin-top:10px;">
                <div>
                    <label style="display:block; margin-bottom:8px; color:#adb5bd;">Full Name</label>
                    <input type="text" name="full_name" value="<?php echo escape($user['full_name']); ?>" 
                           style="width:100%; padding:10px; background:#1a1a1a; border:1px solid #404040; color:#e0e0e0; border-radius:5px;" required>
                </div>
                <div>
                    <label style="display:block; margin-bottom:8px; color:#adb5bd;">Email</label>
                    <input type="email" name="email" value="<?php echo escape($user['email']); ?>" 
                           style="width:100%; padding:10px; background:#1a1a1a; border:1px solid #404040; color:#e0e0e0; border-radius:5px;" required>
                </div>
            </div>
            
            <div style="margin-top:30px;">
                <button type="submit" name="update_profile" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </form>
        
        <hr style="border:1px solid #404040; margin:30px 0;">
        
        <form method="POST">
            <h4 style="color:#f0f0f0; margin-bottom:15px;">Change Password</h4>
            <div style="display:grid; grid-template-columns:1fr; gap:15px;">
                <div>
                    <label style="display:block; margin-bottom:8px; color:#adb5bd;">Current Password</label>
                    <input type="password" name="current_password" 
                           style="width:100%; padding:10px; background:#1a1a1a; border:1px solid #404040; color:#e0e0e0; border-radius:5px;" required>
                </div>
                <div>
                    <label style="display:block; margin-bottom:8px; color:#adb5bd;">New Password</label>
                    <input type="password" name="new_password" 
                           style="width:100%; padding:10px; background:#1a1a1a; border:1px solid #404040; color:#e0e0e0; border-radius:5px;" required>
                </div>
                <div>
                    <label style="display:block; margin-bottom:8px; color:#adb5bd;">Confirm New Password</label>
                    <input type="password" name="confirm_password" 
                           style="width:100%; padding:10px; background:#1a1a1a; border:1px solid #404040; color:#e0e0e0; border-radius:5px;" required>
                </div>
            </div>
            
            <div style="margin-top:20px;">
                <button type="submit" name="change_password" class="btn btn-outline">
                    <i class="fas fa-key"></i> Update Password
                </button>
            </div>
        </form>
    </div>
</div>