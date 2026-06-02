<?php
function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function getTasks($pdo, $userId, $status = null) {
    $sql = "SELECT * FROM tasks WHERE user_id = ?";
    $params = [$userId];
    
    if ($status) {
        $sql .= " AND status = ?";
        $params[] = $status;
    }
    
    $sql .= " ORDER BY 
        CASE priority 
            WHEN 'high' THEN 1 
            WHEN 'medium' THEN 2 
            WHEN 'low' THEN 3 
        END, due_date ASC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function getWellnessEntries($pdo, $userId, $days = 7) {
    $stmt = $pdo->prepare("
        SELECT * FROM wellness_entries 
        WHERE user_id = ? 
        AND entry_date >= DATE_SUB(CURDATE(), INTERVAL ? DAY)
        ORDER BY entry_date DESC
    ");
    $stmt->execute([$userId, $days]);
    return $stmt->fetchAll();
}

function getTodaysWellness($pdo, $userId) {
    $stmt = $pdo->prepare("
        SELECT * FROM wellness_entries 
        WHERE user_id = ? AND entry_date = CURDATE()
    ");
    $stmt->execute([$userId]);
    return $stmt->fetch();
}

function calculateInsights($pdo, $userId) {
    // Get last 30 days of data
    $stmt = $pdo->prepare("
        SELECT 
            we.entry_date,
            we.sleep_hours,
            we.mood_rating,
            we.exercise_minutes,
            COUNT(t.task_id) as tasks_completed
        FROM wellness_entries we
        LEFT JOIN tasks t ON t.user_id = we.user_id 
            AND DATE(t.updated_at) = we.entry_date 
            AND t.status = 'completed'
        WHERE we.user_id = ? 
            AND we.entry_date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
        GROUP BY we.entry_date, we.sleep_hours, we.mood_rating, we.exercise_minutes
        ORDER BY we.entry_date DESC
    ");
    $stmt->execute([$userId]);
    $data = $stmt->fetchAll();
    
    // Calculate sleep vs productivity correlation
    $sleepDays = array_filter($data, function($row) {
        return $row['sleep_hours'] >= 7;
    });
    
    $avgTasksGoodSleep = count($sleepDays) > 0 ? 
        array_sum(array_column($sleepDays, 'tasks_completed')) / count($sleepDays) : 0;
    
    $allTasks = array_sum(array_column($data, 'tasks_completed'));
    $avgTasksAll = count($data) > 0 ? $allTasks / count($data) : 0;
    
    if ($avgTasksAll > 0) {
        $improvement = round(($avgTasksGoodSleep - $avgTasksAll) / $avgTasksAll * 100);
        
        // Save insight
        $insightText = "When you sleep 7+ hours, you complete {$improvement}% more tasks the next day";
        $stmt = $pdo->prepare("
            INSERT INTO correlation_insights (user_id, insight_type, insight_text, correlation_value) 
            VALUES (?, 'sleep_productivity', ?, ?)
        ");
        $stmt->execute([$userId, $insightText, $improvement/100]);
    }
}

function getMoodStars($rating) {
    $stars = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            $stars .= '<span style="color: #fab005; font-size: 16px;">★</span>';
        } else {
            $stars .= '<span style="color: #868e96; font-size: 16px;">★</span>';
        }
    }
    return $stars;
}

function getInitials($name) {
    $words = explode(' ', $name);
    $initials = '';
    foreach ($words as $word) {
        $initials .= strtoupper(substr($word, 0, 1));
    }
    return substr($initials, 0, 2);
}
?>