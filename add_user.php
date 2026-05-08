<div id="addUserModal" class="modal-overlay" style="display: none;">
    <div class="modal-content edit-blue-card">
        <div class="modal-header">
            <h3>ADD NEW USER</h3>
            <hr>
        </div>
        <form action="index.php?action=add_user" method="POST">
            <div class="modal-body">
                <div class="input-group">
                    <label>NEW USERNAME</label>
                    <input type="text" name="new_username" class="modal-input" placeholder="Enter username" required>
                </div>

                <div class="input-group">
                    <label>POSITION</label>
                    <select name="new_position" class="modal-input">
                        <option value="STAFF">STAFF</option>
                        <option value="CHIEF TECHNOLOGIST">CHIEF TECHNOLOGIST</option>
                        <option value="ADMIN">ADMIN</option>
                    </select>
                </div>

                <div class="input-group">
                    <label>TEMPORARY PASSWORD</label>
                    <input type="password" name="new_password" class="modal-input" placeholder="Set password" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-modal-cancel" onclick="closeModal('addUserModal')">CANCEL</button>
                <button type="submit" class="btn-modal-save">CREATE</button>
            </div>
        </form>
    </div>
</div>