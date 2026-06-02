<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'includes/session.php';
require_once 'includes/functions.php';

$pageTitle = 'Insights';
$includeCharts = true;
$userId = $_SESSION['user_id'];

// Calculate insights if needed
calculateInsights($pdo, $userId);

// Get insights
$stmt = $pdo->prepare("
    SELECT * FROM correlation_insights 
    WHERE user_id = ? 
    ORDER BY created_at DESC 
    LIMIT 1
");
$stmt->execute([$userId]);
$insight = $stmt->fetch();

// Get data for graphs (last 14 days) - ADDED energy_level
$stmt = $pdo->prepare("
    SELECT 
        we.entry_date,
        we.sleep_hours,
        we.mood_rating,
        we.exercise_minutes,
        we.energy_level,
        COUNT(t.task_id) as tasks_completed
    FROM wellness_entries we
    LEFT JOIN tasks t ON t.user_id = we.user_id 
        AND DATE(t.updated_at) = we.entry_date 
        AND t.status = 'completed'
    WHERE we.user_id = ? 
        AND we.entry_date >= DATE_SUB(CURDATE(), INTERVAL 14 DAY)
    GROUP BY we.entry_date, we.sleep_hours, we.mood_rating, we.exercise_minutes, we.energy_level
    ORDER BY we.entry_date ASC
");
$stmt->execute([$userId]);
$chartData = $stmt->fetchAll();

// Calculate summary statistics
$avgSleep = 0;
$avgMood = 0;
$avgExercise = 0;
$avgTasks = 0;
$sleepCorrelation = 0;
$exerciseCorrelation = 0;

if (!empty($chartData)) {
    $totalSleep = 0;
    $totalMood = 0;
    $totalExercise = 0;
    $totalTasks = 0;
    $count = count($chartData);
    
    // Calculate averages
    foreach ($chartData as $row) {
        $totalSleep += $row['sleep_hours'];
        $totalMood += $row['mood_rating'];
        $totalExercise += $row['exercise_minutes'];
        $totalTasks += $row['tasks_completed'];
    }
    
    $avgSleep = round($totalSleep / $count, 1);
    $avgMood = round($totalMood / $count, 1);
    $avgExercise = round($totalExercise / $count);
    $avgTasks = round($totalTasks / $count, 1);
    
    // Calculate simple correlations
    $highSleepDays = array_filter($chartData, function($row) {
        return $row['sleep_hours'] >= 7;
    });
    $lowSleepDays = array_filter($chartData, function($row) {
        return $row['sleep_hours'] < 7;
    });
    
    $avgTasksHighSleep = !empty($highSleepDays) ? 
        array_sum(array_column($highSleepDays, 'tasks_completed')) / count($highSleepDays) : 0;
    $avgTasksLowSleep = !empty($lowSleepDays) ? 
        array_sum(array_column($lowSleepDays, 'tasks_completed')) / count($lowSleepDays) : 0;
    
    if ($avgTasksLowSleep > 0) {
        $sleepCorrelation = round(($avgTasksHighSleep - $avgTasksLowSleep) / $avgTasksLowSleep * 100);
    }
    
    // Exercise correlation
    $exerciseDays = array_filter($chartData, function($row) {
        return $row['exercise_minutes'] >= 20;
    });
    $noExerciseDays = array_filter($chartData, function($row) {
        return $row['exercise_minutes'] < 20;
    });
    
    $avgMoodExercise = !empty($exerciseDays) ? 
        array_sum(array_column($exerciseDays, 'mood_rating')) / count($exerciseDays) : 0;
    $avgMoodNoExercise = !empty($noExerciseDays) ? 
        array_sum(array_column($noExerciseDays, 'mood_rating')) / count($noExerciseDays) : 0;
    
    if ($avgMoodNoExercise > 0) {
        $exerciseCorrelation = round(($avgMoodExercise - $avgMoodNoExercise) / $avgMoodNoExercise * 100);
    }
}

// Generate summary statement
if ($sleepCorrelation > 0 && $exerciseCorrelation > 0) {
    $summaryStatement = "Your data shows that on days with 7+ hours of sleep, you complete <strong>{$sleepCorrelation}% more tasks</strong>. 
    Days with 20+ minutes of exercise are associated with <strong>{$exerciseCorrelation}% higher mood ratings</strong>.";
} elseif ($sleepCorrelation > 0) {
    $summaryStatement = "Getting 7+ hours of sleep helps you complete <strong>{$sleepCorrelation}% more tasks</strong> the next day. 
    Try to maintain consistent sleep for better productivity.";
} elseif ($exerciseCorrelation > 0) {
    $summaryStatement = "Exercise makes you happier! Days with 20+ minutes of exercise show <strong>{$exerciseCorrelation}% higher mood ratings</strong>.";
} else {
    $summaryStatement = "Keep logging your wellness data to receive personalized insights about how your habits affect your productivity and mood.";
}

include 'templates/dashboard-header.php';
include 'templates/insights-content.php';
include 'templates/dashboard-footer.php';
?>