<div class="container" style="padding: 60px 0;">
    <div style="max-width: 400px; margin: 0 auto;">
        <div class="card">
            <h2 style="text-align: center; margin-bottom: 25px;">Login to LifeFlow</h2>
            
            <?php if (!empty($error)): ?>
                <div style="background: #dc3545; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                    <?php echo escape($error); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-input" placeholder="email@example.com" required value="<?php echo isset($_POST['email']) ? escape($_POST['email']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-input" placeholder="••••••••" required>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
            
            <div style="text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid #404040;">
                <p style="color: #868e96;">Don't have an account? <a href="register.php" style="color: #4dabf7;">Register here</a></p>
                <p style="color: #868e96; margin-top: 10px;"><a href="index.php" style="color: #4dabf7;"><i class="fas fa-arrow-left"></i> Back to Home</a></p>
            </div>
        </div>
    </div>
</div>