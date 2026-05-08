<div id="editModal" class="modal-overlay" style="display: none;">
    <div class="modal-content edit-blue-card">
        <div class="modal-header">
            <h3>EDIT</h3>
            <hr>
        </div>
        <form action="index.php?action=update_account" method="POST">
            <div class="modal-body">
                <div class="input-group">
                    <label>USERNAME</label>
                    <input type="text" name="username" value="<?= htmlspecialchars($user['username'] ?? '') ?>" class="modal-input" required>
                </div>

                <div class="input-group">
                    <label>POSITION</label>
                    <select name="position" class="modal-input">
                        <?php $currentPos = $user['position'] ?? ''; ?>
                        <option value="STAFF" <?= $currentPos == 'STAFF' ? 'selected' : '' ?>>STAFF</option>
                        <option value="CHIEF TECHNOLOGIST" <?= $currentPos == 'CHIEF TECHNOLOGIST' ? 'selected' : '' ?>>CHIEF TECHNOLOGIST</option>
                        <option value="ADMIN" <?= $currentPos == 'ADMIN' ? 'selected' : '' ?>>ADMIN</option>
                    </select>
                </div>

                <div class="input-group">
                    <label>PASSWORD</label>
                    <input type="password" name="current_password" class="modal-input" placeholder="Current Password" required>
                </div>

                <div class="input-group">
                    <label>NEW PASSWORD</label>
                    <input type="password" name="new_password" class="modal-input" placeholder="New Password (Optional)">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-modal-cancel" onclick="closeModal('editModal')">CANCEL</button>
                <button type="submit" class="btn-modal-save">SAVE</button>
            </div>
        </form>
    </div>
</div>