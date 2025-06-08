<div id="user-section">
    <h2>借書</h2>
    <form action="/assets/pages/borrow.php" method="POST" class="form-container">
        <label for="ISBN">ISBN:</label>
        <input type="text" id="ISBN" name="ISBN" required>
        
        <label for="borrow_date">借書日期:</label>
        <input type="date" id="borrow_date" name="borrow_date" required>
        
        <div class="button-container">
            <button type="submit">借書</button>
            <button type="button" onclick="window.location.href='/assets/pages/return.php'" class="btn-function">還書</button>
        </div>
        <?php
        if (isset($_GET['section']) && $_GET['section'] === 'user' && isset($_GET['borrow'])) {
            switch ($_GET['borrow']) {
                case 'success':
                    echo "<div class='alert alert-success'>✅ 借書成功！</div>";
                    break;
                case 'overdue':
                    echo "<div class='alert alert-danger'>🚫 您有逾期未還的書，請先歸還。</div>";
                    break;
                case 'invalid':
                    echo "<div class='alert alert-warning'>⚠️ 資料輸入不完整或錯誤。</div>";
                    break;
                case 'error':
                    echo "<div class='alert alert-danger'>❌ 借書失敗，請檢查您的輸入。</div>";
                    break;
                default:
                    echo "<div class='alert alert-danger'>❌ 借書失敗，請再試一次。</div>";
                    break;
            }
        }
        ?>
    </form>
</div>