<div id="myModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('employee.reset') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Update Employee Password</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pwd" class="control-label">Current Password:</label>
                        <div>
                            <input type="password" name="old_password"  class="form-control @error('old_password') is-invalid @enderror" placeholder="Enter current Password">
                            @error('old_password')
                            <span class="error" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">New Password :</label>
                        <div>
                            <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="Enter New Password" >
                            @error('new_password')
                            <span class="error" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pwd" class="control-label">Confirm New Password:</label>
                        <div>
                            <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Enter Confirm Password">
                            @error('confirm_password')
                            <span class="error" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>