<div class="mt-5">
    <!-- バリデーションエラーの場合 -->
    <div class="text-danger">
        <?php echo $error; ?>
    </div>

    <form action="create.php" method="post" class="mt-4">
        <div class="form-group">
            <label for="memo" class="h5">メモ入力欄</label>
        </div>
        <div class="form-group">
            <textarea name="memo" id="memo" cols="80" rows="10" class="form-control"></textarea>
        </div>
        <div class="mt-2">
            <button type="submit" class="btn btn-dark">メモを登録する</button>
        </div>
    </form>
    <div class="mt-4">
        <a href="index.php" class="btn btn-light">メモを閲覧する</a>
    </div>
</div>
