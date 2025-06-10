<div id="admin-section">
    <h2>管理員操作</h2>
    <form action="/assets/pages/admin_action.php" method="POST" class="form-container">
        <label for="action">選擇操作:</label>
        <select id="action" name="action" required>
            <option value="">-- 請選擇 --</option>
            <option value="add">新增書籍</option>
            <option value="update">修改書籍</option>
            <option value="delete">刪除書籍</option>
            <option value="view_logs">查看借閱紀錄</option>
        </select>

        <div class="button-container">
            <button type="submit">執行操作</button>
        </div>
    </form>
</div>