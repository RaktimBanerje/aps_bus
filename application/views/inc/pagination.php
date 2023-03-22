<div class="d-flex justify-content-between align-items-center">
    <div class="form-inline">
        <label for="limit">Per page:</label>
        <select class="form-control ml-2" name="limit" id="limit">
            <option value="05" <?php if(5 == $limit) { echo "selected"; }?>>05</option>
            <option value="10" <?php if(10 == $limit) { echo "selected"; }?>>10</option>
            <option value="20" <?php if(20 == $limit) { echo "selected"; }?>>20</option>
            <option value="30" <?php if(30 == $limit) { echo "selected"; }?>>30</option>
            <option value="40" <?php if(40 == $limit) { echo "selected"; }?>>40</option>
            <option value="50" <?php if(50 == $limit) { echo "selected"; }?>>50</option>
        </select>
    </div>
    <div id="loader" class="spinner-border text-primary" style="display: none;"></div>
    <div id="pagination_link">
        <?php echo $pagination_link ?>
    </div>
</div>