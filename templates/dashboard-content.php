<h2>Your Dashboard</h2>
<p class="subtitle">Welcome back! Here's your overview.</p>

<div class="dashboard-grid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-tasks"></i> Today's Tasks</h3>
        </div>
        <?php if (empty($todaysTasks)): ?>
            <p style="color: #868e96; text-align: center; padding: 20px;">No pending tasks. Great job!</p>
        <?php else: ?>
            <ul class="task-list">
                <?php foreach ($todaysTasks as $task): ?>
                <li class="task-item">
                    <input type="checkbox" class="task-checkbox" data-task-id="<?php echo $task['task_id']; ?>">
                    <span class="task-text"><?php echo escape($task['title']); ?></span>
                    <?php if ($task['priority'] === 'high'): ?>
                        <span style="background: #4dabf7; color: white; padding: 3px 8px; border-radius: 4px; font-size: 12px;">High</span>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <a href="tasks.php" class="btn btn-outline btn-small view-tasks-btn">
            View All Tasks
        </a>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-heartbeat"></i> Today's Wellness</h3>
        </div>
        <?php if ($todaysWellness): ?>
            <div class="wellness-stats">
                <div class="stat wellness-stat">
                    <span class="stat-label">Sleep:</span>
                    <strong class="stat-value"><?php echo $todaysWellness['sleep_hours']; ?> hours</strong>
                </div>
                <div class="stat wellness-stat">
                    <span class="stat-label">Mood:</span>
                    <strong class="stat-value"><?php echo $todaysWellness['mood_rating']; ?>/5</strong>
                </div>
                <div class="stat wellness-stat">
                    <span class="stat-label">Exercise:</span>
                    <strong class="stat-value"><?php echo $todaysWellness['exercise_minutes']; ?> mins</strong>
                </div>
            </div>
        <?php else: ?>
            <p style="color: #868e96; text-align: center; padding: 20px;">No wellness data logged today</p>
        <?php endif; ?>
        <a href="wellness.php" class="btn btn-outline btn-small log-wellness-btn">
            <?php echo $todaysWellness ? 'Update Wellness' : 'Log Wellness'; ?>
        </a>
    </div>
</div>

<?php if ($insight): ?>
<div class="card insight-card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-chart-line"></i> Weekly Insight</h3>
    </div>
    <p class="insight-text"><?php echo escape($insight['insight_text']); ?></p>
    <a href="insights.php" class="btn btn-primary btn-small view-insights-btn">
        See More Insights
    </a>
</div>
<?php endif; ?>