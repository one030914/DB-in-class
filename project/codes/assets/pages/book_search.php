<div id="book-search">
    <h2>書本查詢</h2>
    <form action="/assets/pages/book_query.php" method="post" class="form-container">
        <select name="type" required>
            <option value="">--請選擇--</option>
            <option value="ISBN">ISBN</option>
            <option value="title">書名</option>
            <option value="genre">類別</option>
            <option value="author">作者</option>
            <option value="year">出版年份</option>
            <option value="publisher">出版社</option>
        </select>
        <input type="text" name="search" placeholder="請輸入檢索詞" required>
        <button type="submit">查詢</button>
    </form>
</div>