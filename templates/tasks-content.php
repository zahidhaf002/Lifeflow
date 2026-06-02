<h2>Task Management</h2>
<p style="color:#adb5bd; margin-bottom:30px;">Manage your tasks and deadlines</p>

<?php if (!empty($success)): ?>
    <div style="background: #40c057; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
        <?php echo escape($success); ?>
    </div>
<?php endif; ?>

<div class="card">
    <h3 class="card-title">Add New Task</h3>
    <form method="POST">
        <div style="display:grid; grid-template-columns:2fr 1fr 1fr; gap:10px; margin-bottom:15px;">
            <input type="text" name="title" placeholder="Task title..." required
                   style="padding:10px; background:#1a1a1a; border:1px solid #404040; color:#e0e0e0; border-radius:5px;">
            <input type="date" name="due_date" 
                   style="padding:10px; background:#1a1a1a; border:1px solid #404040; color:#e0e0e0; border-radius:5px;">
            <select name="priority" style="padding:10px; background:#1a1a1a; border:1px solid #404040; color:#e0e0e0; border-radius:5px;">
                <option value="low">Low Priority</option>
                <option value="medium" selected>Medium Priority</option>
                <option value="high">High Priority</option>
            </select>
        </div>
        <textarea name="description" placeholder="Description (optional)" 
                  style="width:100%; padding:10px; background:#1a1a1a; border:1px solid #404040; color:#e0e0e0; border-radius:5px; margin-bottom:15px;"
                  rows="2"></textarea>
        <button type="submit" name="add_task" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Task
        </button>
    </form>
</div>

<div class="card">
    <h3 class="card-title">Your Tasks</h3>
    
    <div style="margin-top:20px;">
        <?php foreach ($tasks as $task): ?>
        <div style="padding:15px; border-bottom:1px solid #404040; display:flex; align-items:center; gap:15px;">
            <input type="checkbox" <?php echo $task['status'] === 'completed' ? 'checked' : ''; ?> 
                   onchange="updateTaskStatus(<?php echo $task['task_id']; ?>, this.checked)">
            <div style="flex-grow:1; <?php echo $task['status'] === 'completed' ? 'text-decoration:line-through; opacity:0.6;' : ''; ?>">
                <div style="font-weight:bold; color:#e0e0e0;"><?php echo escape($task['title']); ?></div>
                <?php if ($task['description']): ?>
                    <div style="color:#adb5bd; font-size:14px;"><?php echo escape($task['description']); ?></div>
                <?php endif; ?>
                <?php if ($task['due_date']): ?>
                    <div style="color:#adb5bd; font-size:14px;">Due: <?php echo date('M j, Y', strtotime($task['due_date'])); ?></div>
                <?php endif; ?>
            </div>
            <span style="
                background: <?php 
                    echo $task['priority'] === 'high' ? '#4dabf7' : 
                        ($task['priority'] === 'medium' ? '#fab005' : '#868e96'); 
                ?>; 
                color: white; padding:5px 10px; border-radius:4px; font-size:12px;">
                <?php echo ucfirst($task['priority']); ?>
            </span>
            <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this task?');">
                <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                <button type="submit" name="delete_task" class="btn btn-small btn-danger">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
        <?php endforeach; ?>
        
        <?php if (empty($tasks)): ?>
            <p style="color: #868e96; text-align: center; padding: 20px;">No tasks yet. Add your first task above!</p>
        <?php endif; ?>
    </div>
</div>

<script>
function updateTaskStatus(taskId, completed) {
    fetch('api/update_task_status.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
            task_id: taskId,
            status: completed ? 'completed' : 'pending'
        })
    });
}
</script>