<!-- モーダルのHTML -->
<div id="deleteUserModal{{ $user->id }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">本当に退会してもよろしいですか？</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">キャンセル</button>
                <form id="deleteForm" method="POST" action="{{ route('mypage.destroy',$user->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" id="logout-button" disabled>退会する</button>
                </form>
            </div>
        </div>
    </div>
</div>