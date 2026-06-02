<div class="container">
    <h2>Your Insights</h2>
    <p class="subtitle">Discover patterns between your productivity and wellbeing</p>
    
    <!-- Wellness Summary Card - Purple border only -->
    <div class="card insight-card" style="border: 2px solid #7950f2; margin-bottom: 30px;">
        <div class="card-header" style="border-bottom: none; padding-bottom: 0; margin-bottom: 15px;">
            <h3 class="card-title" style="color: #f0f0f0; font-size: 18px;">
                <i class="fas fa-chart-line" style="color: #7950f2;"></i> 
                Your Wellness Summary
            </h3>
        </div>
        <div style="display: flex; align-items: center; gap: 15px;">
            <div style="background: #7950f2; width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-lightbulb" style="color: white; font-size: 24px;"></i>
            </div>
            <div style="flex: 1;">
                <p class="insight-text" style="margin-bottom: 0; font-size: 16px;">
                    <?php echo $summaryStatement; ?>
                </p>
            </div>
        </div>
    </div>
    
    <!-- Averages Cards - Matching your dashboard card style -->
    <?php if (!empty($chartData)): ?>
    <div class="dashboard-grid" style="grid-template-columns: repeat(4, 1fr); gap: 20px; margin: 30px 0;">
        <div class="card" style="text-align: center; padding: 20px;">
            <div style="color: #4dabf7; font-size: 32px; font-weight: 700;"><?php echo $avgSleep; ?>h</div>
            <div style="color: #adb5bd; font-size: 14px; margin-top: 5px;">Avg Sleep</div>
        </div>
        <div class="card" style="text-align: center; padding: 20px;">
            <div style="color: #fab005; font-size: 32px; font-weight: 700;"><?php echo $avgMood; ?>/5</div>
            <div style="color: #adb5bd; font-size: 14px; margin-top: 5px;">Avg Mood</div>
        </div>
        <div class="card" style="text-align: center; padding: 20px;">
            <div style="color: #40c057; font-size: 32px; font-weight: 700;"><?php echo $avgExercise; ?>m</div>
            <div style="color: #adb5bd; font-size: 14px; margin-top: 5px;">Avg Exercise</div>
        </div>
        <div class="card" style="text-align: center; padding: 20px;">
            <div style="color: #7950f2; font-size: 32px; font-weight: 700;"><?php echo $avgTasks; ?></div>
            <div style="color: #adb5bd; font-size: 14px; margin-top: 5px;">Daily Tasks</div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Two Main Correlation Graphs -->
    <div class="dashboard-grid" style="grid-template-columns: 1fr 1fr; gap: 25px; margin-top: 30px;">
        
        <!-- Graph 1: Sleep vs Productivity -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-bed" style="color: #4dabf7;"></i> 
                    Sleep vs Productivity
                </h3>
            </div>
            <p style="color: #adb5bd; font-size: 14px; margin-bottom: 20px;">How your sleep hours affect daily task completion</p>
            <?php if (empty($chartData)): ?>
                <div style="height: 250px; display: flex; align-items: center; justify-content: center; background: #1a1a1a; border-radius: 8px;">
                    <p style="color: #868e96;">Not enough data yet. Keep logging!</p>
                </div>
            <?php else: ?>
                <div style="height: 280px; position: relative;">
                    <canvas id="sleepProductivityChart"></canvas>
                </div>
            <?php endif; ?>
            <div style="margin-top: 15px; padding-top: 12px; border-top: 1px solid #333; display: flex; justify-content: center; gap: 25px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <div style="width: 20px; height: 3px; background: #4dabf7;"></div>
                    <span style="color: #adb5bd; font-size: 12px;">Sleep Hours</span>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <div style="width: 20px; height: 3px; background: #40c057;"></div>
                    <span style="color: #adb5bd; font-size: 12px;">Tasks Completed</span>
                </div>
            </div>
        </div>
        
        <!-- Graph 2: Exercise vs Mood -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-running" style="color: #40c057;"></i> 
                    Exercise vs Mood
                </h3>
            </div>
            <p style="color: #adb5bd; font-size: 14px; margin-bottom: 20px;">How exercise minutes correlate with your daily mood</p>
            <?php if (empty($chartData)): ?>
                <div style="height: 250px; display: flex; align-items: center; justify-content: center; background: #1a1a1a; border-radius: 8px;">
                    <p style="color: #868e96;">Not enough data yet. Keep logging!</p>
                </div>
            <?php else: ?>
                <div style="height: 280px; position: relative;">
                    <canvas id="exerciseMoodChart"></canvas>
                </div>
            <?php endif; ?>
            <div style="margin-top: 15px; padding-top: 12px; border-top: 1px solid #333; display: flex; justify-content: center; gap: 25px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <div style="width: 20px; height: 3px; background: #40c057;"></div>
                    <span style="color: #adb5bd; font-size: 12px;">Exercise (mins)</span>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <div style="width: 20px; height: 3px; background: #fab005;"></div>
                    <span style="color: #adb5bd; font-size: 12px;">Mood Rating</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bottom Row: Key Stats & Tips -->
    <div class="dashboard-grid" style="grid-template-columns: 1fr 1fr; gap: 25px; margin-top: 25px;">
        
        <!-- Box 1: Correlation Stats Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-simple" style="color: #fab005;"></i> 
                    Key Correlations
                </h3>
            </div>
            <div style="padding: 10px 0;">
                <?php if ($sleepCorrelation > 0): ?>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #333;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-bed" style="color: #4dabf7; width: 24px;"></i>
                        <span style="color: #e0e0e0;">Sleep 7+ hours</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="background: #40c057; padding: 4px 10px; border-radius: 20px;">
                            <span style="color: white; font-size: 14px; font-weight: 600;">+<?php echo $sleepCorrelation; ?>% tasks</span>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if ($exerciseCorrelation > 0): ?>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #333;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-running" style="color: #40c057; width: 24px;"></i>
                        <span style="color: #e0e0e0;">Exercise 20+ mins</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="background: #fab005; padding: 4px 10px; border-radius: 20px;">
                            <span style="color: #1a1a1a; font-size: 14px; font-weight: 600;">+<?php echo $exerciseCorrelation; ?>% mood</span>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if ($avgSleep > 0): ?>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-chart-line" style="color: #7950f2; width: 24px;"></i>
                        <span style="color: #e0e0e0;">Average daily tasks</span>
                    </div>
                    <div>
                        <span style="color: #4dabf7; font-size: 18px; font-weight: 700;"><?php echo $avgTasks; ?></span>
                        <span style="color: #adb5bd;"> tasks/day</span>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Box 2: Personalized Tips with NHS Safety Referrals -->
<div class="card insight-card" style="border-color: #7950f2;">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-lightbulb" style="color: #fab005;"></i> 
            Personalized Tips
        </h3>
    </div>
    <div style="padding: 10px 0;">
        
        <!-- TIP 1: SLEEP IMPACT -->
        <?php if ($sleepCorrelation > 40): ?>
        <div style="display: flex; gap: 12px; padding: 10px 0; border-bottom: 1px solid #333;">
            <i class="fas fa-bed" style="color: #4dabf7; margin-top: 3px;"></i>
            <p style="color: #adb5bd; font-size: 14px; margin: 0;">CRITICAL: You complete <?php echo $sleepCorrelation; ?>% MORE tasks after 7+ hours sleep. Prioritize your bedtime!</p>
        </div>
        <?php elseif ($sleepCorrelation > 25): ?>
        <div style="display: flex; gap: 12px; padding: 10px 0; border-bottom: 1px solid #333;">
            <i class="fas fa-bed" style="color: #4dabf7; margin-top: 3px;"></i>
            <p style="color: #adb5bd; font-size: 14px; margin: 0;">Sleep matters! You're <?php echo $sleepCorrelation; ?>% more productive after good sleep. Try to maintain 7-8 hours.</p>
        </div>
        <?php elseif ($sleepCorrelation > 10): ?>
        <div style="display: flex; gap: 12px; padding: 10px 0; border-bottom: 1px solid #333;">
            <i class="fas fa-bed" style="color: #4dabf7; margin-top: 3px;"></i>
            <p style="color: #adb5bd; font-size: 14px; margin: 0;">Small sleep improvements add up! You're <?php echo $sleepCorrelation; ?>% more productive with 7+ hours sleep.</p>
        </div>
        <?php elseif ($sleepCorrelation < 0 && $sleepCorrelation > -20): ?>
        <div style="display: flex; gap: 12px; padding: 10px 0; border-bottom: 1px solid #333;">
            <i class="fas fa-bed" style="color: #4dabf7; margin-top: 3px;"></i>
            <p style="color: #adb5bd; font-size: 14px; margin: 0;">Your productivity drops <?php echo abs($sleepCorrelation); ?>% on days with less sleep. Try going to bed 30 minutes earlier.</p>
        </div>
        <?php elseif ($sleepCorrelation <= -20): ?>
        <div style="display: flex; gap: 12px; padding: 10px 0; border-bottom: 1px solid #333; background: rgba(220, 53, 69, 0.05); margin: 5px 0; border-radius: 8px;">
            <i class="fas fa-exclamation-triangle" style="color: #dc3545; margin-top: 3px;"></i>
            <div style="flex: 1;">
                <p style="color: #adb5bd; font-size: 14px; margin: 0 0 5px 0;">Your productivity drops significantly (<?php echo abs($sleepCorrelation); ?>%) on days with less sleep. Consistent poor sleep may need attention.</p>
                <a href="https://www.nhs.uk/live-well/sleep-and-tiredness/how-to-get-to-sleep/" target="_blank" style="color: #4dabf7; text-decoration: none; font-size: 13px;">
                    <i class="fas fa-external-link-alt"></i> NHS Sleep Advice
                </a>
            </div>
        </div>
        <?php else: ?>
        <div style="display: flex; gap: 12px; padding: 10px 0; border-bottom: 1px solid #333;">
            <i class="fas fa-bed" style="color: #4dabf7; margin-top: 3px;"></i>
            <p style="color: #adb5bd; font-size: 14px; margin: 0;">Keep tracking your sleep to see patterns between rest and productivity.</p>
        </div>
        <?php endif; ?>
        
        <!-- TIP 2: EXERCISE & MOOD (Combined into one) -->
        <?php if ($exerciseCorrelation > 40): ?>
        <div style="display: flex; gap: 12px; padding: 10px 0; border-bottom: 1px solid #333;">
            <i class="fas fa-running" style="color: #40c057; margin-top: 3px;"></i>
            <p style="color: #adb5bd; font-size: 14px; margin: 0;">MASSIVE MOOD BOOST! Exercise makes you <?php echo $exerciseCorrelation; ?>% happier. Don't skip your workouts!</p>
        </div>
        <?php elseif ($exerciseCorrelation > 25): ?>
        <div style="display: flex; gap: 12px; padding: 10px 0; border-bottom: 1px solid #333;">
            <i class="fas fa-running" style="color: #40c057; margin-top: 3px;"></i>
            <p style="color: #adb5bd; font-size: 14px; margin: 0;">Exercise equals happiness! Your mood is <?php echo $exerciseCorrelation; ?>% better on active days. Keep moving!</p>
        </div>
        <?php elseif ($exerciseCorrelation > 10): ?>
        <div style="display: flex; gap: 12px; padding: 10px 0; border-bottom: 1px solid #333;">
            <i class="fas fa-running" style="color: #40c057; margin-top: 3px;"></i>
            <p style="color: #adb5bd; font-size: 14px; margin: 0;">Even small amounts of exercise help! Your mood improves by <?php echo $exerciseCorrelation; ?>% on active days.</p>
        </div>
        <?php elseif ($exerciseCorrelation <= -10): ?>
        <div style="display: flex; gap: 12px; padding: 10px 0; border-bottom: 1px solid #333; background: rgba(220, 53, 69, 0.05); margin: 5px 0; border-radius: 8px;">
            <i class="fas fa-heartbeat" style="color: #dc3545; margin-top: 3px;"></i>
            <div style="flex: 1;">
                <p style="color: #adb5bd; font-size: 14px; margin: 0 0 5px 0;">Your mood is significantly lower (<?php echo abs($exerciseCorrelation); ?>%) on inactive days. Support is available.</p>
                <a href="https://www.nhs.uk/mental-health/" target="_blank" style="color: #4dabf7; text-decoration: none; font-size: 13px;">
                    <i class="fas fa-external-link-alt"></i> NHS Mental Health Support
                </a>
            </div>
        </div>
        <?php else: ?>
        <div style="display: flex; gap: 12px; padding: 10px 0; border-bottom: 1px solid #333;">
            <i class="fas fa-running" style="color: #40c057; margin-top: 3px;"></i>
            <p style="color: #adb5bd; font-size: 14px; margin: 0;">Log more exercise data to see how activity affects your mood and energy!</p>
        </div>
        <?php endif; ?>
        
        <!-- TIP 3: ENERGY LEVELS -->
        <?php
        $avgEnergyScore = 3;
        if (!empty($chartData)) {
            $energyMap = ['very_low' => 1, 'low' => 2, 'medium' => 3, 'high' => 4, 'very_high' => 5];
            $energyScores = [];
            foreach ($chartData as $day) {
                if (isset($day['energy_level']) && !empty($day['energy_level'])) {
                    $energyScores[] = $energyMap[$day['energy_level']] ?? 3;
                }
            }
            if (!empty($energyScores)) {
                $avgEnergyScore = array_sum($energyScores) / count($energyScores);
            }
        }
        ?>
        
        <?php if ($avgEnergyScore >= 4): ?>
        <div style="display: flex; gap: 12px; padding: 10px 0; border-bottom: 1px solid #333;">
            <i class="fas fa-bolt" style="color: #fab005; margin-top: 3px;"></i>
            <p style="color: #adb5bd; font-size: 14px; margin: 0;">HIGH ENERGY! You're consistently energetic. Protect this with good sleep and nutrition!</p>
        </div>
        <?php elseif ($avgEnergyScore <= 2): ?>
        <div style="display: flex; gap: 12px; padding: 10px 0; border-bottom: 1px solid #333; background: rgba(220, 53, 69, 0.05); margin: 5px 0; border-radius: 8px;">
            <i class="fas fa-tired" style="color: #dc3545; margin-top: 3px;"></i>
            <div style="flex: 1;">
                <p style="color: #adb5bd; font-size: 14px; margin: 0 0 5px 0;">Your energy levels are consistently low. Chronic fatigue may need medical attention.</p>
                <a href="https://www.nhs.uk/conditions/tiredness-and-fatigue/" target="_blank" style="color: #4dabf7; text-decoration: none; font-size: 13px;">
                    <i class="fas fa-external-link-alt"></i> NHS Fatigue Advice
                </a>
            </div>
        </div>
        <?php else: ?>
        <div style="display: flex; gap: 12px; padding: 10px 0; border-bottom: 1px solid #333;">
            <i class="fas fa-bolt" style="color: #fab005; margin-top: 3px;"></i>
            <p style="color: #adb5bd; font-size: 14px; margin: 0;">Track your energy levels to find what drains or boosts your energy!</p>
        </div>
        <?php endif; ?>
        
        <!-- TIP 4: LOW MOOD (Single consolidated tip) -->
        <?php if ($avgMood <= 2 && !empty($chartData)): ?>
        <div style="display: flex; gap: 12px; padding: 10px 0; background: rgba(220, 53, 69, 0.05); margin-top: 5px; border-radius: 8px;">
            <i class="fas fa-heart" style="color: #dc3545; margin-top: 3px;"></i>
            <div style="flex: 1;">
                <p style="color: #adb5bd; font-size: 14px; margin: 0 0 5px 0;">Your average mood is <?php echo $avgMood; ?>/5. If you're struggling, support is available.</p>
                <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                    <a href="https://www.nhs.uk/mental-health/" target="_blank" style="color: #4dabf7; text-decoration: none; font-size: 13px;">
                        <i class="fas fa-external-link-alt"></i> NHS Mental Health
                    </a>
                    <a href="https://checkwellbeing.leadershipacademy.nhs.uk/" target="_blank" style="color: #4dabf7; text-decoration: none; font-size: 13px;">
                        <i class="fas fa-external-link-alt"></i> NHS Mood Self-Assessment
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- GENERAL TIP (always shows) -->
        <div style="display: flex; gap: 12px; padding: 10px 0; margin-top: 5px;">
            <i class="fas fa-check-circle" style="color: #40c057; margin-top: 3px;"></i>
            <p style="color: #adb5bd; font-size: 14px; margin: 0;">Keep logging daily - more data equals more accurate personalized insights!</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chartData = <?php echo json_encode($chartData); ?>;
    
    if (chartData.length > 0) {
        // Format dates
        const labels = chartData.map(d => {
            const date = new Date(d.entry_date);
            return date.toLocaleDateString('en-GB', { month: 'short', day: 'numeric' });
        });
        
        // ============================================
        // CHART 1: Sleep vs Productivity (Dual Axis)
        // ============================================
        const sleepCtx = document.getElementById('sleepProductivityChart').getContext('2d');
        new Chart(sleepCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Sleep Hours',
                        data: chartData.map(d => d.sleep_hours),
                        borderColor: '#4dabf7',
                        backgroundColor: 'rgba(77, 171, 247, 0.05)',
                        borderWidth: 2,
                        tension: 0.3,
                        pointBackgroundColor: '#4dabf7',
                        pointBorderColor: '#252525',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Tasks Completed',
                        data: chartData.map(d => d.tasks_completed),
                        borderColor: '#40c057',
                        backgroundColor: 'rgba(64, 192, 87, 0.05)',
                        borderWidth: 2,
                        tension: 0.3,
                        pointBackgroundColor: '#40c057',
                        pointBorderColor: '#252525',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e1e1e',
                        titleColor: '#f0f0f0',
                        bodyColor: '#adb5bd',
                        borderColor: '#4dabf7',
                        borderWidth: 1,
                        padding: 10
                    }
                },
                scales: {
                    y: {
                        position: 'left',
                        title: { display: true, text: 'Sleep Hours', color: '#adb5bd', font: { size: 11 } },
                        min: 0, max: 10,
                        grid: { color: '#333' },
                        ticks: { color: '#adb5bd', stepSize: 2, callback: (v) => v + ' hrs' }
                    },
                    y1: {
                        position: 'right',
                        title: { display: true, text: 'Tasks Completed', color: '#adb5bd', font: { size: 11 } },
                        min: 0,
                        grid: { drawOnChartArea: false },
                        ticks: { color: '#adb5bd', stepSize: 2, callback: (v) => v + ' tasks' }
                    },
                    x: {
                        title: { display: true, text: 'Date', color: '#adb5bd', font: { size: 11 } },
                        grid: { color: '#333', display: false },
                        ticks: { color: '#adb5bd', maxRotation: 45, minRotation: 45 }
                    }
                }
            }
        });
        
        // ============================================
        // CHART 2: Exercise vs Mood (Bar + Line Combo)
        // ============================================
        const exerciseCtx = document.getElementById('exerciseMoodChart').getContext('2d');
        new Chart(exerciseCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Exercise Minutes',
                        data: chartData.map(d => d.exercise_minutes),
                        type: 'bar',
                        backgroundColor: '#40c057',
                        borderRadius: 4,
                        barPercentage: 0.6,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Mood Rating',
                        data: chartData.map(d => d.mood_rating),
                        type: 'line',
                        borderColor: '#fab005',
                        backgroundColor: 'rgba(250, 176, 5, 0.05)',
                        borderWidth: 2,
                        tension: 0.3,
                        pointBackgroundColor: '#fab005',
                        pointBorderColor: '#252525',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        fill: true,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e1e1e',
                        titleColor: '#f0f0f0',
                        bodyColor: '#adb5bd',
                        borderColor: '#fab005',
                        borderWidth: 1,
                        padding: 10
                    }
                },
                scales: {
                    y: {
                        position: 'left',
                        title: { display: true, text: 'Exercise (mins)', color: '#adb5bd', font: { size: 11 } },
                        beginAtZero: true,
                        grid: { color: '#333' },
                        ticks: { color: '#adb5bd', stepSize: 15, callback: (v) => v + ' min' }
                    },
                    y1: {
                        position: 'right',
                        title: { display: true, text: 'Mood Rating', color: '#adb5bd', font: { size: 11 } },
                        min: 1, max: 5,
                        grid: { drawOnChartArea: false },
                        ticks: { color: '#adb5bd', stepSize: 1, callback: (v) => v + '/5' }
                    },
                    x: {
                        title: { display: true, text: 'Date', color: '#adb5bd', font: { size: 11 } },
                        grid: { color: '#333', display: false },
                        ticks: { color: '#adb5bd', maxRotation: 45, minRotation: 45 }
                    }
                }
            }
        });
    }
});
</script>