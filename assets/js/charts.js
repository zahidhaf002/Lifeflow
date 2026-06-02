/**
 * Charts.js - Chart configuration and helpers for LifeFlow Insights
 * This file contains reusable chart configurations and helper functions
 */

// Chart.js global defaults for dark theme
Chart.defaults.color = '#adb5bd';
Chart.defaults.borderColor = '#333';

// Color palette for charts
const chartColors = {
    primary: '#4dabf7',
    success: '#40c057',
    warning: '#fab005',
    secondary: '#7950f2',
    danger: '#dc3545',
    grid: '#333',
    text: '#adb5bd',
    background: 'rgba(77, 171, 247, 0.1)'
};

/**
 * Create a sleep vs productivity chart
 * @param {string} canvasId - The canvas element ID
 * @param {Array} data - Chart data array with dates, sleep hours, and tasks
 */
function createSleepChart(canvasId, data) {
    const ctx = document.getElementById(canvasId)?.getContext('2d');
    if (!ctx) return;

    return new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.map(d => d.entry_date),
            datasets: [
                {
                    label: 'Sleep Hours',
                    data: data.map(d => d.sleep_hours),
                    borderColor: chartColors.primary,
                    backgroundColor: 'rgba(77, 171, 247, 0.1)',
                    tension: 0.3,
                    yAxisID: 'y',
                    fill: true,
                    pointBackgroundColor: chartColors.primary,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                },
                {
                    label: 'Tasks Completed',
                    data: data.map(d => d.tasks_completed),
                    borderColor: chartColors.success,
                    backgroundColor: 'rgba(64, 192, 87, 0.1)',
                    tension: 0.3,
                    yAxisID: 'y1',
                    fill: true,
                    pointBackgroundColor: chartColors.success,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false
            },
            plugins: {
                legend: {
                    labels: {
                        color: chartColors.text,
                        font: {
                            size: 12
                        }
                    },
                    position: 'top'
                },
                tooltip: {
                    backgroundColor: '#1e1e1e',
                    titleColor: '#f0f0f0',
                    bodyColor: '#adb5bd',
                    borderColor: '#333',
                    borderWidth: 1,
                    padding: 10,
                    displayColors: true
                }
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Sleep Hours',
                        color: chartColors.text
                    },
                    grid: {
                        color: chartColors.grid,
                        drawBorder: false
                    },
                    ticks: {
                        color: chartColors.text,
                        stepSize: 1,
                        callback: function(value) {
                            return value + 'h';
                        }
                    },
                    min: 0,
                    max: 12
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    title: {
                        display: true,
                        text: 'Tasks Completed',
                        color: chartColors.text
                    },
                    grid: {
                        drawOnChartArea: false,
                        color: chartColors.grid
                    },
                    ticks: {
                        color: chartColors.text,
                        stepSize: 1
                    },
                    min: 0
                },
                x: {
                    grid: {
                        color: chartColors.grid,
                        drawBorder: false
                    },
                    ticks: {
                        color: chartColors.text,
                        maxRotation: 45,
                        minRotation: 45,
                        font: {
                            size: 11
                        }
                    }
                }
            }
        }
    });
}

/**
 * Create an exercise vs mood chart
 * @param {string} canvasId - The canvas element ID
 * @param {Array} data - Chart data array with dates, mood, and exercise
 */
function createMoodChart(canvasId, data) {
    const ctx = document.getElementById(canvasId)?.getContext('2d');
    if (!ctx) return;

    return new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.map(d => d.entry_date),
            datasets: [
                {
                    label: 'Mood Rating',
                    data: data.map(d => d.mood_rating),
                    backgroundColor: chartColors.warning,
                    borderRadius: 4,
                    yAxisID: 'y',
                    barPercentage: 0.6,
                    categoryPercentage: 0.8
                },
                {
                    label: 'Exercise (mins)',
                    data: data.map(d => d.exercise_minutes),
                    type: 'line',
                    borderColor: chartColors.success,
                    backgroundColor: 'transparent',
                    borderWidth: 3,
                    tension: 0.3,
                    yAxisID: 'y1',
                    pointBackgroundColor: chartColors.success,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    order: 0
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false
            },
            plugins: {
                legend: {
                    labels: {
                        color: chartColors.text,
                        font: {
                            size: 12
                        }
                    },
                    position: 'top'
                },
                tooltip: {
                    backgroundColor: '#1e1e1e',
                    titleColor: '#f0f0f0',
                    bodyColor: '#adb5bd',
                    borderColor: '#333',
                    borderWidth: 1,
                    padding: 10,
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.dataset.label === 'Mood Rating') {
                                label += context.raw + '/5';
                            } else {
                                label += context.raw + ' mins';
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5,
                    title: {
                        display: true,
                        text: 'Mood (1-5)',
                        color: chartColors.text
                    },
                    grid: {
                        color: chartColors.grid,
                        drawBorder: false
                    },
                    ticks: {
                        color: chartColors.text,
                        stepSize: 1,
                        callback: function(value) {
                            return value + '/5';
                        }
                    }
                },
                y1: {
                    position: 'right',
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Exercise Minutes',
                        color: chartColors.text
                    },
                    grid: {
                        drawOnChartArea: false,
                        color: chartColors.grid
                    },
                    ticks: {
                        color: chartColors.text,
                        stepSize: 15,
                        callback: function(value) {
                            return value + 'm';
                        }
                    }
                },
                x: {
                    grid: {
                        color: chartColors.grid,
                        drawBorder: false
                    },
                    ticks: {
                        color: chartColors.text,
                        maxRotation: 45,
                        minRotation: 45,
                        font: {
                            size: 11
                        }
                    }
                }
            }
        }
    });
}

/**
 * Create a weekly summary chart (tasks completed per day)
 * @param {string} canvasId - The canvas element ID
 * @param {Array} data - Chart data array with dates and tasks
 */
function createWeeklyTasksChart(canvasId, data) {
    const ctx = document.getElementById(canvasId)?.getContext('2d');
    if (!ctx) return;

    return new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.map(d => d.entry_date),
            datasets: [
                {
                    label: 'Tasks Completed',
                    data: data.map(d => d.tasks_completed),
                    backgroundColor: chartColors.primary,
                    borderRadius: 4,
                    barPercentage: 0.7,
                    categoryPercentage: 0.8
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1e1e1e',
                    titleColor: '#f0f0f0',
                    bodyColor: '#adb5bd',
                    borderColor: '#333',
                    borderWidth: 1
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Tasks',
                        color: chartColors.text
                    },
                    grid: {
                        color: chartColors.grid,
                        drawBorder: false
                    },
                    ticks: {
                        color: chartColors.text,
                        stepSize: 1
                    }
                },
                x: {
                    grid: {
                        color: chartColors.grid,
                        drawBorder: false
                    },
                    ticks: {
                        color: chartColors.text,
                        maxRotation: 45,
                        minRotation: 45
                    }
                }
            }
        }
    });
}

/**
 * Create a sleep quality distribution pie chart
 * @param {string} canvasId - The canvas element ID
 * @param {Object} data - Sleep distribution data
 */
function createSleepDistributionChart(canvasId, data) {
    const ctx = document.getElementById(canvasId)?.getContext('2d');
    if (!ctx) return;

    return new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Good Sleep (7+ hrs)', 'Average Sleep (5-7 hrs)', 'Poor Sleep (<5 hrs)'],
            datasets: [{
                data: [data.good || 0, data.average || 0, data.poor || 0],
                backgroundColor: [
                    chartColors.success,
                    chartColors.warning,
                    chartColors.danger
                ],
                borderColor: '#1e1e1e',
                borderWidth: 2,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: chartColors.text,
                        font: {
                            size: 12
                        }
                    },
                    position: 'bottom'
                },
                tooltip: {
                    backgroundColor: '#1e1e1e',
                    titleColor: '#f0f0f0',
                    bodyColor: '#adb5bd',
                    borderColor: '#333',
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                            return `${label}: ${value} days (${percentage}%)`;
                        }
                    }
                }
            },
            cutout: '60%'
        }
    });
}

/**
 * Update chart data dynamically
 * @param {Chart} chart - Chart.js instance
 * @param {Array} newData - New data array
 */
function updateChartData(chart, newData) {
    if (chart) {
        chart.data.labels = newData.map(d => d.entry_date);
        chart.data.datasets.forEach((dataset, index) => {
            if (index === 0) {
                dataset.data = newData.map(d => d.sleep_hours || d.mood_rating || d.tasks_completed);
            } else if (chart.data.datasets.length > 1) {
                dataset.data = newData.map(d => d.tasks_completed || d.exercise_minutes);
            }
        });
        chart.update();
    }
}

/**
 * Export chart as image
 * @param {string} canvasId - The canvas element ID
 * @param {string} filename - Download filename
 */
function exportChartAsImage(canvasId, filename = 'chart.png') {
    const canvas = document.getElementById(canvasId);
    if (canvas) {
        const link = document.createElement('a');
        link.download = filename;
        link.href = canvas.toDataURL('image/png');
        link.click();
    }
}

// Make functions available globally
window.LifeFlowCharts = {
    createSleepChart,
    createMoodChart,
    createWeeklyTasksChart,
    createSleepDistributionChart,
    updateChartData,
    exportChartAsImage,
    colors: chartColors
};