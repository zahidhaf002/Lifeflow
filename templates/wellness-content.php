<h2>Wellness Tracking</h2>
<p style="color:#adb5bd; margin-bottom:30px;">Track your health and wellbeing metrics</p>

<?php if (!empty($success)): ?>
    <div style="background: #40c057; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
        <?php echo escape($success); ?>
    </div>
<?php endif; ?>

<div class="card">
    <h3 class="card-title">Log Today's Wellness</h3>
    <form method="POST">
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:15px; margin-top:20px;">
            <div>
                <label style="display:block; margin-bottom:8px; color:#adb5bd;">Sleep Hours</label>
                <input type="number" name="sleep_hours" min="0" max="24" step="0.5" 
                       value="<?php echo $todaysWellness['sleep_hours'] ?? 7.5; ?>" 
                       style="width:100%; padding:12px; background:#1a1a1a; border:1px solid #404040; color:#e0e0e0; border-radius:5px;" required>
            </div>
            
            <div>
                <label style="display:block; margin-bottom:8px; color:#adb5bd;">Mood (1-5)</label>
                <input type="number" name="mood_rating" min="1" max="5" 
                       value="<?php echo $todaysWellness['mood_rating'] ?? 4; ?>" 
                       style="width:100%; padding:12px; background:#1a1a1a; border:1px solid #404040; color:#e0e0e0; border-radius:5px;" required>
            </div>
            
            <div>
                <label style="display:block; margin-bottom:8px; color:#adb5bd;">Exercise (mins)</label>
                <input type="number" name="exercise_minutes" min="0" max="300" 
                       value="<?php echo $todaysWellness['exercise_minutes'] ?? 30; ?>" 
                       style="width:100%; padding:12px; background:#1a1a1a; border:1px solid #404040; color:#e0e0e0; border-radius:5px;" required>
            </div>
            
            <div>
                <label style="display:block; margin-bottom:8px; color:#adb5bd;">Energy Level</label>
                <select name="energy_level" style="width:100%; padding:12px; background:#1a1a1a; border:1px solid #404040; color:#e0e0e0; border-radius:5px;" required>
                    <option value="very_low" <?php echo ($todaysWellness['energy_level'] ?? '') === 'very_low' ? 'selected' : ''; ?>>Very Low</option>
                    <option value="low" <?php echo ($todaysWellness['energy_level'] ?? '') === 'low' ? 'selected' : ''; ?>>Low</option>
                    <option value="medium" <?php echo ($todaysWellness['energy_level'] ?? 'medium') === 'medium' ? 'selected' : ''; ?>>Medium</option>
                    <option value="high" <?php echo ($todaysWellness['energy_level'] ?? '') === 'high' ? 'selected' : ''; ?>>High</option>
                    <option value="very_high" <?php echo ($todaysWellness['energy_level'] ?? '') === 'very_high' ? 'selected' : ''; ?>>Very High</option>
                </select>
            </div>
        </div>
        
        <button type="submit" name="save_wellness" class="btn btn-primary" style="margin-top:20px;">
            <i class="fas fa-save"></i> Save Today's Log
        </button>
    </form>
</div>

<div class="card">
    <h3 class="card-title">Wellness History</h3>
    
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Sleep</th>
                <th>Mood</th>
                <th>Exercise</th>
                <th>Energy</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recentEntries as $entry): ?>
            <tr>
                <td><?php echo date('M j, Y', strtotime($entry['entry_date'])); ?></td>
                <td style="color:#40c057;"><?php echo $entry['sleep_hours']; ?>h</td>
                <td><?php echo getMoodStars($entry['mood_rating']); ?></td>
                <td style="color:#4dabf7;"><?php echo $entry['exercise_minutes']; ?>min</td>
                <td><?php echo ucfirst(str_replace('_', ' ', $entry['energy_level'])); ?></td>
            </tr>
            <?php endforeach; ?>
            
            <?php if (empty($recentEntries)): ?>
            <tr>
                <td colspan="5" style="text-align: center; color: #868e96;">No wellness data yet</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>