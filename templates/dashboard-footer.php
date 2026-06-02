        </div> <!-- Close container -->
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-bottom">
                <p>&copy; 2026 LifeFlow - <?php echo $pageTitle ?? 'Dashboard'; ?></p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Task checkboxes
            document.querySelectorAll('.task-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const taskId = this.dataset.taskId;
                    const taskText = this.nextElementSibling;
                    
                    if (this.checked) {
                        taskText.classList.add('completed');
                    } else {
                        taskText.classList.remove('completed');
                    }
                    
                    fetch('api/update_task_status.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({
                            task_id: taskId,
                            status: this.checked ? 'completed' : 'pending'
                        })
                    });
                });
            });
        });
    </script>
</body>
</html>