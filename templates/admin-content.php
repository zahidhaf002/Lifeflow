<?php
// templates/admin-content.php
?>

<div class="container">
    <h2>Admin Panel</h2>
    <p style="color:#adb5bd; margin-bottom:30px;">Manage users and system settings</p>

    <?php if (!empty($success)): ?>
        <div style="background: #40c057; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($success); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div style="background: #dc3545; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <!-- CREATE USER SECTION -->
    <div class="card" style="margin-bottom: 30px;">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-user-plus"></i> Create New User</h3>
        </div>
        <form method="POST" action="admin.php">
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; color: #adb5bd;">Full Name</label>
                    <input type="text" name="new_full_name" class="form-input" placeholder="John Smith" required>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; color: #adb5bd;">Email</label>
                    <input type="email" name="new_email" class="form-input" placeholder="user@example.com" required>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; color: #adb5bd;">Password</label>
                    <input type="password" name="new_password" class="form-input" placeholder="••••••••" required>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; color: #adb5bd;">Role</label>
                    <select name="new_role" class="form-input">
                        <option value="student">Student</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
            <button type="submit" name="create_user" class="btn btn-primary" style="margin-top: 20px;">
                <i class="fas fa-save"></i> Create User
            </button>
        </form>
    </div>

    <!-- SYSTEM STATISTICS -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
        <div style="background: #1a1a1a; padding: 25px; border-radius: 8px; text-align: center;">
            <div style="font-size: 36px; color: #4dabf7; font-weight: bold;"><?php echo $totalUsers ?? 0; ?></div>
            <div style="color: #adb5bd;">Total Users</div>
            <div style="margin-top: 10px; font-size: 13px;">
                <span style="color: #4dabf7;">Admins: <?php echo $adminCount ?? 0; ?></span> | 
                <span style="color: #40c057;">Students: <?php echo $studentCount ?? 0; ?></span>
            </div>
        </div>
        <div style="background: #1a1a1a; padding: 25px; border-radius: 8px; text-align: center;">
            <div style="font-size: 36px; color: #40c057; font-weight: bold;"><?php echo $totalTasks ?? 0; ?></div>
            <div style="color: #adb5bd;">Total Tasks</div>
        </div>
        <div style="background: #1a1a1a; padding: 25px; border-radius: 8px; text-align: center;">
            <div style="font-size: 36px; color: #fab005; font-weight: bold;"><?php echo $totalWellness ?? 0; ?></div>
            <div style="color: #adb5bd;">Wellness Entries</div>
        </div>
        <div style="background: #1a1a1a; padding: 25px; border-radius: 8px; text-align: center;">
            <div style="font-size: 36px; color: #7950f2; font-weight: bold;"><?php echo $totalInsights ?? 0; ?></div>
            <div style="color: #adb5bd;">Insights</div>
        </div>
    </div>

    <!-- BULK OPERATIONS -->
    <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h3 class="card-title"><i class="fas fa-users"></i> User Management</h3>
            <div style="display: flex; gap: 10px;">
                <button onclick="selectAllUsers()" class="btn btn-small btn-outline">Select All</button>
                <button onclick="bulkDeleteUsers()" class="btn btn-small btn-danger">Delete Selected</button>
            </div>
        </div>

        <!-- USERS TABLE -->
        <table class="table" style="width: 100%; margin-top: 20px;">
            <thead>
                <tr>
                    <th style="width: 30px;"><input type="checkbox" id="selectAllCheckbox" onclick="toggleAllCheckboxes()"></th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Joined</th>
                    <th style="width: 150px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr id="user-row-<?php echo $user['user_id']; ?>">
                    <td>
                        <?php if ($user['user_id'] != $_SESSION['user_id']): ?>
                            <input type="checkbox" class="user-checkbox" value="<?php echo $user['user_id']; ?>">
                        <?php endif; ?>
                    </td>
                    <td>#<?php echo $user['user_id']; ?></td>
                    <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td>
                        <span style="background: <?php echo $user['role'] === 'admin' ? '#7950f2' : '#4dabf7'; ?>; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;">
                            <?php echo ucfirst($user['role']); ?>
                        </span>
                    </td>
                    <td><?php echo date('M j, Y', strtotime($user['created_at'])); ?></td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <?php if ($user['user_id'] != $_SESSION['user_id']): ?>
                                <!-- EDIT BUTTON - Opens Modal -->
                                <button onclick="openEditModal(<?php echo $user['user_id']; ?>, '<?php echo addslashes($user['full_name']); ?>', '<?php echo $user['email']; ?>', '<?php echo $user['role']; ?>')" 
                                        class="btn btn-small btn-primary" style="padding: 5px 10px;">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                
                                <!-- DELETE BUTTON - Form -->
                                <form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this user? This will delete all their data.');">
                                    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                    <button type="submit" name="delete_user" class="btn btn-small btn-danger" style="padding: 5px 10px;">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            <?php else: ?>
                                <span style="color: #868e96; font-style: italic;">(Current User)</span>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <!-- Hidden Form for Bulk Delete -->
        <form id="bulkDeleteForm" method="POST" action="admin.php" style="display: none;">
            <input type="hidden" name="bulk_delete" id="bulkDeleteInput">
        </form>
    </div>
</div>

<!-- EDIT USER MODAL -->
<div id="editModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background: #1e1e1e; padding: 30px; border-radius: 8px; width: 400px; border: 1px solid #333;">
        <h3 style="color: white; margin-bottom: 20px; display: flex; justify-content: space-between;">
            Edit User
            <span onclick="closeEditModal()" style="cursor: pointer; color: #868e96;">✕</span>
        </h3>
        <form id="editForm" method="POST" action="admin.php">
            <input type="hidden" name="edit_user_id" id="edit_user_id">
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px; color: #adb5bd;">Full Name</label>
                <input type="text" name="edit_full_name" id="edit_full_name" class="form-input" required>
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px; color: #adb5bd;">Email</label>
                <input type="email" name="edit_email" id="edit_email" class="form-input" required>
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: #adb5bd;">Role</label>
                <select name="edit_role" id="edit_role" class="form-input">
                    <option value="student">Student</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: #adb5bd;">New Password (leave blank to keep current)</label>
                <input type="password" name="edit_password" class="form-input" placeholder="••••••••">
            </div>
            
            <div style="display: flex; gap: 10px;">
                <button type="submit" name="update_user" class="btn btn-primary" style="flex: 1;">Update User</button>
                <button type="button" onclick="closeEditModal()" class="btn btn-outline" style="flex: 1;">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript for Admin Functions -->
<script>
// Select All Checkboxes
function toggleAllCheckboxes() {
    const selectAll = document.getElementById('selectAllCheckbox');
    const checkboxes = document.querySelectorAll('.user-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
}

function selectAllUsers() {
    const checkboxes = document.querySelectorAll('.user-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = true;
    });
    document.getElementById('selectAllCheckbox').checked = true;
}

// Bulk Delete
function bulkDeleteUsers() {
    const checkboxes = document.querySelectorAll('.user-checkbox:checked');
    if (checkboxes.length === 0) {
        alert('Please select users to delete');
        return;
    }
    
    if (confirm('Are you sure you want to delete ' + checkboxes.length + ' selected users?')) {
        const userIds = Array.from(checkboxes).map(cb => cb.value).join(',');
        document.getElementById('bulkDeleteInput').value = userIds;
        document.getElementById('bulkDeleteForm').submit();
    }
}

// Edit Modal Functions
function openEditModal(userId, fullName, email, role) {
    document.getElementById('edit_user_id').value = userId;
    document.getElementById('edit_full_name').value = fullName;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_role').value = role;
    document.getElementById('editModal').style.display = 'flex';
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

// Close modal if clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('editModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>