<?php
$pageTitle = 'Home';
include 'templates/header.php';
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">Unify Your Productivity & Wellness</h1>
                <p class="hero-subtitle">LifeFlow bridges the gap between task management and health tracking</p>
                
                <div class="hero-features">
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Integrated dashboard for tasks & wellness</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-chart-line"></i>
                        <span>Smart insights and correlations</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-bell"></i>
                        <span>Personalized recommendations</span>
                    </div>
                </div>
                
                <div class="hero-buttons">
                    <a href="register.php" class="btn btn-primary btn-large">
                        <i class="fas fa-rocket"></i> Get Started 
                    </a>
                    <a href="#dashboard-preview" class="btn btn-outline btn-large">
                        <i class="fas fa-play-circle"></i> Dashboard
                    </a>
                </div>
                
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number">2-in-1</div>
                        <div class="stat-label">Platform</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">94%</div>
                        <div class="stat-label">User Satisfaction</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">30%</div>
                        <div class="stat-label">Productivity Boost</div>
                    </div>
                </div>
            </div>
            
            <div class="hero-image-side">
                <div class="dashboard-mockup">
                    <div class="mockup-header">
                        <div class="mockup-tabs">
                            <span class="mockup-tab active">Dashboard</span>
                            <span class="mockup-tab">Tasks</span>
                            <span class="mockup-tab">Wellness</span>
                        </div>
                        <div class="mockup-time">Today</div>
                    </div>
                    
                    <div class="mockup-content">
                        <div class="mockup-left">
                            <div class="mockup-section">
                                <h4><i class="fas fa-tasks"></i> Today's Tasks</h4>
                                <ul class="mockup-list">
                                    <li class="completed">Finish project proposal</li>
                                    <li class="pending">Email supervisor</li>
                                    <li class="pending">Study for exam</li>
                                    <li class="completed">Morning workout</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="mockup-right">
                            <div class="mockup-section">
                                <h4><i class="fas fa-heartbeat"></i> Wellness</h4>
                                <div class="wellness-visual">
                                    <div class="progress-visual">
                                        <div class="progress-label">Sleep Quality</div>
                                        <div class="progress-bar">
                                            <div class="progress-fill" style="width: 85%"></div>
                                        </div>
                                        <div class="progress-value">85%</div>
                                    </div>
                                    <div class="progress-visual">
                                        <div class="progress-label">Energy Level</div>
                                        <div class="progress-bar">
                                            <div class="progress-fill" style="width: 70%"></div>
                                        </div>
                                        <div class="progress-value">70%</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="insight-bubble">
                                <i class="fas fa-lightbulb"></i>
                                <span>Better sleep = 30% more focus</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="image-caption">
                    LifeFlow Dashboard - See your tasks and wellness metrics together
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features" id="features">
    <div class="container">
        <h2 class="section-title">Everything You Need in One Place</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-tasks" style="color: #4dabf7;"></i>
                </div>
                <h3>Smart Task Management</h3>
                <p>Organize deadlines, to-do lists, and projects with intelligent task tracking and prioritization.</p>
                <a href="register.php" class="btn btn-outline">Try Task Manager</a>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-heartbeat" style="color: #40c057;"></i>
                </div>
                <h3>Wellness Tracking</h3>
                <p>Monitor sleep, mood, exercise, and energy levels to understand your personal wellness patterns.</p>
                <a href="register.php" class="btn btn-outline">Track Wellness</a>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-line" style="color: #7950f2;"></i>
                </div>
                <h3>Data-Driven Insights</h3>
                <p>Discover how your wellness affects productivity with personalized analytics and correlations.</p>
                <a href="register.php" class="btn btn-outline">View Insights</a>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="how-it-works" id="how-it-works">
    <div class="container">
        <h2 class="section-title">How LifeFlow Works</h2>
        <div class="steps">
            <div class="step">
                <div class="step-number">1</div>
                <h3>Log Your Day</h3>
                <p>Add tasks and log wellness data through our simple, intuitive dashboard.</p>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <h3>See Connections</h3>
                <p>Our system analyzes patterns between your productivity and wellness metrics.</p>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <h3>Improve Your Routine</h3>
                <p>Get personalized recommendations to optimize both productivity and wellbeing.</p>
            </div>
        </div>
    </div>
</section>

<!-- Dashboard Preview -->
<section class="dashboard-preview-section" id="dashboard-preview">
    <div class="container">
        <h2 class="section-title">Your Unified Dashboard</h2>
        <div class="preview-container">
            <div class="preview-card">
                <div class="preview-header">
                    <h3><i class="fas fa-calendar-day" style="color: #4dabf7;"></i> Today's Tasks</h3>
                </div>
                <ul class="task-list">
                    <li><input type="checkbox"> Finish project proposal</li>
                    <li><input type="checkbox"> Email supervisor</li>
                    <li><input type="checkbox"> Study for exam</li>
                    <li><input type="checkbox"> Team meeting</li>
                </ul>
                <a href="register.php" class="btn btn-outline btn-small">View All Tasks</a>
            </div>
            
            <div class="preview-card">
                <div class="preview-header">
                    <h3><i class="fas fa-heart" style="color: #40c057;"></i> Today's Wellness</h3>
                </div>
                <div class="wellness-stats">
                    <div class="stat">
                        <span>Sleep:</span>
                        <strong>7.5 hours</strong>
                    </div>
                    <div class="stat">
                        <span>Mood:</span>
                        <strong>4/5</strong>
                    </div>
                    <div class="stat">
                        <span>Exercise:</span>
                        <strong>30 mins</strong>
                    </div>
                </div>
                <a href="register.php" class="btn btn-outline btn-small">Log Wellness</a>
            </div>
        </div>
        
        <div class="correlation-insight">
            <div class="insight-content">
                <i class="fas fa-lightbulb" style="color:#7950f2; font-size:28px;"></i>
                <div>
                    <h4>Weekly Insight</h4>
                    <p>When you sleep 7+ hours, you complete <strong>30% more tasks</strong> the next day</p>
                </div>
            </div>
            <a href="register.php" class="btn btn-outline">See More Insights</a>
        </div>
    </div>
</section>



<?php include 'templates/footer.php'; ?>

